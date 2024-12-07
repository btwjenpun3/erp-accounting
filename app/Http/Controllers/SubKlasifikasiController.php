<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use App\Models\SubKlasifikasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubKlasifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.master.subklasifikasi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $klasifikasis = Klasifikasi::orderBy('code', 'asc')->get();

        return view('pages.master.subklasifikasi.create', [
            'klasifikasis' => $klasifikasis,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        SubKlasifikasi::create([
            ...$request->all(),
            ...$request->validate([
                'klasifikasi_code'  => 'required|string',
                'code'              => 'required|string|max:255|unique:sub_klasifikasis,code',
                'name'              => 'required|string|max:255',
                'desc'              => 'nullable|string'
            ])
        ]);

        return redirect()->route('master.sub-klasifikasi.index')->with('success', "Master Subklasifikasi with code {$request->klasifikasi_code}{$request->code} successfully created");
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
    public function edit(SubKlasifikasi $subKlasifikasi)
    {
        $klasifikasis = Klasifikasi::orderBy('code', 'asc')->get();

        return view('pages.master.subklasifikasi.edit', [
            'subKlasifikasi'    => $subKlasifikasi,
            'klasifikasis'      => $klasifikasis
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubKlasifikasi $subKlasifikasi)
    {
        $subKlasifikasi->update([
            ...$request->all(),
            ...$request->validate([
                'klasifikasi_code'  => 'required|string',
                'code' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('sub_klasifikasis', 'code')->ignore($subKlasifikasi->id)
                ],
                'name' => 'required|string|max:255',
                'desc' => 'nullable|string'
            ])
        ]);

        return redirect()->route('master.sub-klasifikasi.index')->with('success', "Master Subklasifikasi with code {$subKlasifikasi->full_code} successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubKlasifikasi $subKlasifikasi)
    {
        $subKlasifikasi->delete();

        return redirect()->route('master.sub-klasifikasi.index')->with('success', "Master Subklasifikasi with code {$subKlasifikasi->full_code} successfully deleted");
    }
}
