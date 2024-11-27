<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ListBomController;
use App\Http\Controllers\ListMaterialRequestController;
use App\Http\Controllers\ListPoSupplierInvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::prefix('/dashboard')
    ->name('dashboard.')
    ->controller(DashboardController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });

Route::prefix('/master')
    ->name('master.')
    ->group(function () {
        Route::prefix('/group')
            ->name('group.')
            ->controller(GroupController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
            });
    });

Route::prefix('/list')
    ->name('list.')
    ->group(function () {
        Route::prefix('/invoice')
            ->name('invoice.')
            ->group(function () {
                Route::get('/po-supplier', [ListPoSupplierInvoiceController::class, 'index'])->name('po-supplier');
            });
        Route::prefix('/material-request')
            ->name('material-request')
            ->group(function () {
                Route::get('/', [ListMaterialRequestController::class, 'index']);
            });
        Route::prefix('/bom')
            ->name('bom')
            ->group(function () {
                Route::get('/', [ListBomController::class, 'index']);
            });
    });

Route::prefix('/datatable')
    ->name('datatable.')
    ->controller(DatatableController::class)
    ->group(function () {
        Route::get('/invoice/po-supplier', 'invoicePoSupplier')->name('invoice.po-supplier');
        Route::get('/material-request', 'materialRequest')->name('material-request');
        Route::get('/bom', 'bom')->name('bom');
    });