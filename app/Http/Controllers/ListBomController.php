<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListBomController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'start_date'    => 'required|date',
            'end_date'      => 'required|date',
        ]);

        try {            
            return view('pages.list.bom.index');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
