<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Klasifikasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KlasifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.master.klasifikasi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = Group::orderBy('code', 'asc')->get();

        return view('pages.master.klasifikasi.create', [
            'groups' => $groups,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Klasifikasi::create([
            ...$request->all(),
            ...$request->validate([
                'group_code'        => 'required|string',
                'code'              => 'required|string|max:255|unique:klasifikasis,code',
                'name'              => 'required|string|max:255',
                'transaction_type'  => 'required|string',
                'desc'              => 'nullable|string'
            ])
        ]);

        return redirect()->route('master.klasifikasi.index')->with('success', "Master Klasifikasi with code {$request->group_code}{$request->code} successfully created");
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
    public function edit(Klasifikasi $klasifikasi)
    {
        $groups = Group::orderBy('code', 'asc')->get();

        return view('pages.master.klasifikasi.edit', [
            'klasifikasi'   => $klasifikasi,
            'groups'        => $groups
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Klasifikasi $klasifikasi)
    {
        $klasifikasi->update([
            ...$request->all(),
            ...$request->validate([
                'group_code' => 'required|string',
                'code' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('klasifikasis', 'code')->ignore($klasifikasi->id)
                ],
                'name'              => 'required|string|max:255',
                'transaction_type'  => 'required|string',
                'desc'              => 'nullable|string'
            ])
        ]);

        return redirect()->route('master.klasifikasi.index')->with('success', "Master Klasifikasi with code {$klasifikasi->full_code} successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
