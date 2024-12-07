<?php

namespace App\Traits;

use App\Models\GeneralJournal;
use Illuminate\Support\Facades\Log;

trait GenerateGeneralJournalReff
{
    public function generateGeneralJournalReff(): string 
    {
        try {
            $generalJournal = GeneralJournal::orderBy('id', 'desc')
                ->first();

            if (! $generalJournal) {
                $generalJournalReff = 'GJ-000001';
            } else {
                $lastReff   = explode('-', $generalJournal->reff);
                $prefix     = $lastReff[0];
                $number     = (int) $lastReff[1];
                $newNumber  = str_pad($number + 1, 6, '0', STR_PAD_LEFT);

                $generalJournalReff = $prefix . '-' . $newNumber;
            }

            return $generalJournalReff;

        } catch (\Exception $e) {
            Log::error('Error while Generate Journal Reff on Traits : ' . $e->getMessage());
        }
    }
}