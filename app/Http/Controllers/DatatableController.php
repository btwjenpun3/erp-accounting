<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\GeneralJournal;
use App\Models\Group;
use App\Models\Klasifikasi;
use App\Models\SubKlasifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class DatatableController extends Controller
{
    /**
     * Master
     */
    public function masterGroup()
    {
        try {
            $groups = Group::all();

            return DataTables::of($groups)                
                ->toJson();

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function masterKlasifikasi()
    {
        try {
            $klasifikasi = Klasifikasi::with(['group'])->get();
            
            return DataTables::of($klasifikasi)  
                ->addColumn('full_code', function (Klasifikasi $klasifikasi) {
                    return $klasifikasi->full_code;
                })              
                ->toJson();

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function masterSubKlasifikasi()
    {
        try {
            $subKlasifikasi = SubKlasifikasi::with(['klasifikasi'])->get();
            
            return DataTables::of($subKlasifikasi)  
                ->addColumn('full_code', function (SubKlasifikasi $subKlasifikasi) {
                    return $subKlasifikasi->full_code;
                })              
                ->toJson();

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function masterAccount()
    {
        try {
            $accounts = Account::with(['subKlasifikasi'])->get();
            
            return DataTables::of($accounts)  
                ->addColumn('full_code', function (Account $accounts) {
                    return $accounts->full_code;
                })              
                ->toJson();

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * API DataTable
     */
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

    /**
     * General Journal
     */
    public function generalJournal(Request $request)
    {
        try {
            $generalJournals = GeneralJournal::query();

            if ($request->has('date_range') && $request->date_range !== null) {
                $dates = explode(' to ', $request->date_range);
                $startDate = $dates[0];
                $endDate = $dates[1];

                $generalJournals->whereBetween('date', [$startDate, $endDate]);
            }

            return DataTables::of($generalJournals)     
                ->addColumn('formatted_date', function (GeneralJournal $generalJournal) {
                    return $generalJournal->formatted_date;
                })         
                ->toJson();

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
