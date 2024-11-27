<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ListPoSupplierInvoiceController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'start_date'    => 'required|date',
            'end_date'      => 'required|date',
        ]);

        try {            
            return view('pages.list.invoice.po-supplier.index');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
