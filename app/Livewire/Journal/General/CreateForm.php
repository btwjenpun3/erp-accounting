<?php

namespace App\Livewire\Journal\General;

use App\Models\Account;
use App\Models\GeneralJournal;
use App\Traits\GenerateGeneralJournalReff;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateForm extends Component
{
    use GenerateGeneralJournalReff;

    public bool $create;

    public string $date;
    public string $reff;
    public string $desc;

    public array $cells = [];

    public int $debitTotal  = 0;
    public int $creditTotal = 0;
    public int $difference  = 0;

    public $generalJournal = null;

    public function mount($generalJournal = null)
    {
        if ($generalJournal) {
            $this->create   = false;
            $this->reff     = $generalJournal->reff;
            $this->desc     = $generalJournal->desc;
            $this->date     = $generalJournal->date;
            
            foreach ($generalJournal->details as $detail) {
                $id = $detail->id;

                $this->cells[$id] = [
                    'account_code'  => $detail->account_code,
                    'currency_code' => $detail->currency_code,
                    'debit'         => $detail->debit,
                    'credit'        => $detail->credit,
                    'current'       => true
                ];
            }

            $this->countDebitTotal();
            $this->countCreditTotal();
            $this->countDifference();

        } else {
            $this->create   = true;
            $this->reff     = $this->generateGeneralJournalReff();
            $this->desc     = 'General Journal';
            $this->date     = now()->format('Y-m-d');

            $this->cells = array_fill(0, 2, [
                'account_code'  => null,
                'currency_code' => null,
                'debit'         => 0,
                'credit'        => 0,
                'current'       => false
            ]);
        }
    }

    public function addCell()
    {
        $this->cells[] = [
            'account_code'  => null,
            'currency_code' => null,
            'debit'         => 0,
            'credit'        => 0,
            'current'       => false
        ];
    }

    public function removeCell($key)
    {
        unset($this->cells[$key]);
        
        $this->countDebitTotal();
        $this->countCreditTotal();
        $this->countDifference();
    }

    public function updatedCells($value, $key)
    {
        [$rowIndex, $field] = explode('.', $key);

        if (in_array($field, ['debit', 'credit'])) {
            $this->cells[$rowIndex][$field] = $this->cells[$rowIndex][$field] ?: 0;

            $field === 'debit' ? $this->countDebitTotal() : $this->countCreditTotal();
        }

        $this->countDifference();
    }

    public function countDebitTotal()
    {
        $this->debitTotal = collect($this->cells)->sum('debit');
    }

    public function countCreditTotal()
    {
        $this->creditTotal = collect($this->cells)->sum('credit');
    }

    public function countDifference()
    {
        $this->difference = $this->debitTotal - $this->creditTotal;
    }

    public function save(bool $status)
    {
        if ($this->difference !== 0) {
            $this->dispatch('toastify-error', 'Debit and Credit not balance!');
            return;
        }

        $this->validate([
            'reff'                  => 'required|string|max:255|unique:general_journals,reff',
            'date'                  => 'required|date',
            'desc'                  => 'required|string|max:255',
            'cells'                 => 'required|array',
            'cells.*.account_code'  => 'required|string|exists:accounts,code',
            'cells.*.currency_code' => 'required|string',
            'cells.*.debit'         => 'required|numeric|min:0',
            'cells.*.credit'        => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $generalJournal = GeneralJournal::create([
                'reff'      => $this->reff,
                'date'      => $this->date,
                'desc'      => $this->desc,
                'status'    => $status
            ]);

            $generalJournal->details()->createMany($this->cells);

            DB::commit();

            return redirect()->route('ledger.general-journal.index')->with('success', "Journal with Reff {$this->reff} successfully created");

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error on Save Journal General : ' . $e->getMessage());
            $this->dispatch('toastify-error', $e->getMessage());
        }
    }

    public function update(bool $status)
    {
        if ($this->difference !== 0) {
            $this->dispatch('toastify-error', 'Debit and Credit not balance!');
            return;
        }

        $this->validate([
            'reff' => [
                'required',
                'string',
                'max:255',
                Rule::unique('general_journals', 'reff')->ignore($this->generalJournal->id)
            ],
            'date'                  => 'required|date',
            'desc'                  => 'required|string|max:255',
            'cells'                 => 'required|array',
            'cells.*.account_code'  => 'required|string|exists:accounts,code',
            'cells.*.currency_code' => 'required|string',
            'cells.*.debit'         => 'required|numeric|min:0',
            'cells.*.credit'        => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $generalJournal = $this->generalJournal;

            $generalJournal->update([
                'reff'      => $this->reff,
                'date'      => $this->date,
                'desc'      => $this->desc,
                'status'    => $status
            ]);

            $cells = $this->cells;

            foreach ($cells as $id => $cell) {
                if ($cell['current'] === true) {
                    $generalJournal->details()->find($id)->update($cell);
                
                } else {
                    $generalJournal->details()->create($cell);
                }
            }

            DB::commit();

            return redirect()->route('ledger.general-journal.index')->with('success', "Journal with Reff {$this->reff} successfully updated");

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error on Update Journal General : ' . $e->getMessage());
            $this->dispatch('toastify-error', $e->getMessage());
        }
    }

    public function render()
    {
        $accounts = Account::orderBy('code', 'asc')->get();

        return view('livewire.journal.general.create-form', [
            'accounts' => $accounts
        ]);
    }
}
