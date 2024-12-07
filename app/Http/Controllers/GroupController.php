<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.master.group.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.master.group.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Group::create([
            ...$request->all(),
            ...$request->validate([
                'code' => 'required|string|max:255|unique:groups,code',
                'name' => 'required|string|max:255',
            ])
        ]);

        return redirect()->route('master.group.index')->with('success', "Master Group with code {$request->code} successfully created");
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
    public function edit(Group $group)
    {
        return view('pages.master.group.edit', [
            'group' => $group,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        $group->update([
            ...$request->all(),
            ...$request->validate([
                'code' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('groups', 'code')->ignore($group->id)
                ],
                'name' => 'required|string|max:255',
            ])
        ]);

        return redirect()->route('master.group.index')->with('success', "Master Group with code {$group->code} successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
