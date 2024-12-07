<?php

namespace App\Http\Controllers;

use App\Models\GeneralJournal;
use Illuminate\Http\Request;

class GeneralJournalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.journal.general.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.journal.general.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GeneralJournal $generalJournal)
    {
        return view('pages.journal.general.show', [
            'generalJournal' => $generalJournal,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GeneralJournal $generalJournal)
    {
        return view('pages.journal.general.edit', [
            'generalJournal' => $generalJournal,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
