<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\SubKlasifikasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.master.account.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subKlasifikasis = SubKlasifikasi::orderBy('code', 'asc')->get();

        return view('pages.master.account.create', [
            'subKlasifikasis' => $subKlasifikasis,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Account::create([
            ...$request->all(),
            ...$request->validate([
                'sub_klasifikasi_code'  => 'required|string',
                'code'                  => 'required|string|max:255|unique:accounts,code',
                'name'                  => 'required|string|max:255',
                'desc'                  => 'nullable|string'
            ])
        ]);

        return redirect()->route('master.account.index')->with('success', "Master Account with code {$request->sub_klasifikasi_code}{$request->code} successfully created");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        $subKlasifikasis = SubKlasifikasi::orderBy('code', 'asc')->get();

        return view('pages.master.account.edit', [
            'account'           => $account,
            'subKlasifikasis'   => $subKlasifikasis
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        $account->update([
            ...$request->all(),
            ...$request->validate([
                'sub_klasifikasi_code'  => 'required|string',
                'code' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('accounts', 'code')->ignore($account->id)
                ],
                'name' => 'required|string|max:255',
            ])
        ]);

        return redirect()->route('master.account.index')->with('success', "Master Account with code {$account->full_code} successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
