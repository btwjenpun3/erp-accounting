<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\GeneralJournalController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\ListBomController;
use App\Http\Controllers\ListMaterialRequestController;
use App\Http\Controllers\ListPoSupplierInvoiceController;
use App\Http\Controllers\SubKlasifikasiController;
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
                Route::get('/{group}/edit', 'edit')->name('edit');
                Route::put('/{group}', 'update')->name('update');
            });
        Route::prefix('/klasifikasi')
            ->name('klasifikasi.')
            ->controller(KlasifikasiController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{klasifikasi}/edit', 'edit')->name('edit');
                Route::put('/{klasifikasi}', 'update')->name('update');
            });
        Route::prefix('/sub-klasifikasi')
            ->name('sub-klasifikasi.')
            ->controller(SubKlasifikasiController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{sub_klasifikasi}/edit', 'edit')->name('edit');
                Route::put('/{sub_klasifikasi}', 'update')->name('update');
                Route::delete('/{sub_klasifikasi}', 'destroy')->name('destroy');
            });
        Route::prefix('/account')
            ->name('account.')
            ->controller(AccountController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{account}/edit', 'edit')->name('edit');
                Route::put('/{account}', 'update')->name('update');
                Route::delete('/{account}', 'destroy')->name('destroy');
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

Route::prefix('/ledger')
    ->name('ledger.')
    ->group(function () {
        Route::prefix('/general-journal')
            ->name('general-journal.')
            ->controller(GeneralJournalController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/{general_journal}/edit', 'edit')->name('edit');
                Route::get('/{general_journal}', 'show')->name('show');
            });
    });

Route::prefix('/datatable')
    ->name('datatable.')
    ->controller(DatatableController::class)
    ->group(function () {
        Route::get('/master/group', 'masterGroup')->name('master.group');
        Route::get('/master/klasifikasi', 'masterKlasifikasi')->name('master.klasifikasi');
        Route::get('/master/sub-klasifikasi', 'masterSubKlasifikasi')->name('master.sub-klasifikasi');
        Route::get('/master/account', 'masterAccount')->name('master.account');

        Route::get('/invoice/po-supplier', 'invoicePoSupplier')->name('invoice.po-supplier');
        Route::get('/material-request', 'materialRequest')->name('material-request');
        Route::get('/bom', 'bom')->name('bom');

        Route::get('/ledger/general-journal', 'generalJournal')->name('general-journal');
    });