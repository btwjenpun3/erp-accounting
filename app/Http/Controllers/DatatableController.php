<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class DatatableController extends Controller
{
    public function invoicePoSupplier(Request $request)
    {
        try {
            $response = Http::get(env('API_URL') . "/invoice/po-supplier?start_date={$request->start_date}&end_date={$request->end_date}");
            
            $invoices = $response->json();

            if ($invoices['code'] === 422) {
                throw new \Exception('Error while fetching data. Please try again later.');
            }

            return DataTables::of($invoices['data'])
                ->addColumn('details', function ($row) {
                    return $row['po']['details'];
                })
                ->toJson();

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function materialRequest(Request $request)
    {
        try {
            $response = Http::get(env('API_URL') . "/material-request?start_date={$request->start_date}&end_date={$request->end_date}");
            
            $materialRequests = $response->json();

            if ($materialRequests['code'] === 422) {
                throw new \Exception('Error while fetching data. Please try again later.');
            }

            return DataTables::of($materialRequests['data'])
                ->addColumn('details', function ($row) {
                    return $row['details'];
                })
                ->toJson();

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function bom(Request $request)
    {
        try {
            $response = Http::get(env('API_URL') . "/bom?start_date={$request->start_date}&end_date={$request->end_date}");
            
            $materialRequests = $response->json();

            if ($materialRequests['code'] === 422) {
                throw new \Exception('Error while fetching data. Please try again later.');
            }

            return DataTables::of($materialRequests['data'])
                ->addColumn('details', function ($row) {
                    return $row['details'];
                })
                ->toJson();

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
