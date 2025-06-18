<?php

use App\Models\Synclog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\BuilderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SheetnameController;
use App\Http\Controllers\SpreadsheetController;
use App\Http\Controllers\SpreadsheetApiController;
use App\Models\SynclogDetail;

Route::get('/welcome', function () {
    return view('welcome', ['title' => 'Welcome']);
});

Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/{id}/detail', [DashboardController::class, 'detail'])->name('dashboard.detail');
});

Route::get('/', function () {
    return view('dashboard', [
        'title' => 'Dashboard',
        'logs' => Synclog::all(),
        'syncLogs' => Synclog::whereIn('id', function ($query) {
            $query->select(DB::raw('MAX(id)'))
                ->from('synclogs')
                ->whereIn('process_name', ['sheetnames', 'questionmedias', 'filemedias'])
                ->groupBy('process_name');
        })->get()
    ]);
});

Route::prefix('spreadsheet')->group(function () {
    Route::get('/', [SpreadsheetController::class, 'index'])->name('spreadsheet.index');

    // Create
    Route::get('/create', [SpreadsheetController::class, 'create'])->name('spreadsheet.create');
    Route::post('/store', [SpreadsheetController::class, 'store'])->name('spreadsheet.store');

    // Update
    Route::get('/{id}/edit', [SpreadsheetController::class, 'edit'])->name('spreadsheet.edit'); // Menampilkan form edit
    Route::put('{id}', [SpreadsheetController::class, 'update'])->name('spreadsheet.update'); // Menyimpan data hasil edit

    // Delete
    Route::delete('/{id}', [SpreadsheetController::class, 'destroy'])->name('spreadsheet.destroy');

    // Route::get('/active', [SpreadsheetController::class, 'activeStatus'])->name('spreadsheet.activeStatus');
    // Route::get('/set-active', [SpreadsheetController::class, 'setActive'])->name('spreadsheet.setActive');
    // Route untuk meng-update row aktif berdasarkan pilihan radio button
    // Route::post('/update-active', [SpreadsheetController::class, 'updateActive'])->name('update.active');
});

Route::prefix('sheetname')->group(function () {
    Route::get('/', [SheetnameController::class, 'index'])->name('sheetname.index');
    Route::get('/{id}/active', [SheetnameController::class, 'active'])->name('sheetname.active');
    Route::post('/update', [SheetnameController::class, 'update'])->name('sheetname.update');
    Route::get('/synchroAll', [SheetnameController::class, 'synchronizeAll'])->name('sheetname.synchroAll');
    Route::get('/{id}/synchroSingle', [SheetnameController::class, 'synchronizeSingle'])->name('sheetname.synchroSingle');
});

Route::prefix('media')->group(function () {
    Route::get('/', [MediaController::class, 'spreadsheet'])->name('media.index');
    Route::get('/{id}/sheetname', [MediaController::class, 'sheetname'])->name('media.sheetname');
    Route::get('/{id}/question', [MediaController::class, 'question'])->name('media.question');
    Route::get('/{guid}/edit', [MediaController::class, 'edit'])->name('media.edit');
    Route::post('/upload', [MediaController::class, 'uploadFile'])->name('media.upload');
    Route::get('/file', [MediaController::class, 'file'])->name('media.file');
    Route::get('/{guid}/editFile', [MediaController::class, 'editFile'])->name('media.editFile');
    Route::get('/synchroQuestionAll', [MediaController::class, 'synchronizeQuestion'])->name('media.synchroQuest');
    Route::get('/{id}/synchroQuestionAllSheet', [MediaController::class, 'synchronizeAllSheet'])->name('media.synchroQuestAllSheet');
    Route::get('/{id}/synchroQuestionSingleSheet', [MediaController::class, 'synchronizeSingleSheet'])->name('media.synchroQuestSingleSheet');
    Route::get('/synchroFile', [MediaController::class, 'synchronizeFile'])->name('media.synchroFile');

    // Delete
    Route::delete('/{id}', [MediaController::class, 'destroy'])->name('media.destroy');
});

Route::prefix('builder')->group(function () {
    Route::get('/truefalse', [BuilderController::class, 'truefalse'])->name('builder.truefalse');
    Route::get('/multichoice', [BuilderController::class, 'multichoice'])->name('builder.multichoice');
    Route::get('/shortanswer', [BuilderController::class, 'shortanswer'])->name('builder.shortanswer');
    Route::get('/bundle', [BuilderController::class, 'bundle'])->name('builder.bundle');
    Route::get('/questions/{type}/{amount}', [BuilderController::class, 'questions_form'])->name('builder.questions.form');

    Route::post('/store-truefalse', [BuilderController::class, 'store_truefalse'])->name('builder.store_truefalse');
    Route::post('/store-multichoice', [BuilderController::class, 'store_multichoice'])->name('builder.store_multichoice');
    Route::post('/store-shortanswer', [BuilderController::class, 'store_shortanswer'])->name('builder.store_shortanswer');
    Route::post('/store-default', [BuilderController::class, 'store_default'])->name('builder.store_default');
    Route::post('/store-bundle-tf', [BuilderController::class, 'store_bundle_tf'])->name('builder.store_bundle_tf');
    Route::post('/store-bundle-mc', [BuilderController::class, 'store_bundle_mc'])->name('builder.store_bundle_mc');
    Route::post('/store-bundle-sa', [BuilderController::class, 'store_bundle_sa'])->name('builder.store_bundle_sa');
});

// Route::get('/get-data-by-token/{token}', [SpreadsheetApiController::class, 'getDataByToken']);
// Route::get('/get-data-by-param/{token}/{sheetNames}', [SpreadsheetApiController::class, 'getDataByParam']);
Route::get('/get-data-by-token/{token}/{randomize?}', [SpreadsheetApiController::class, 'getDataByToken']);
Route::get('/get-data-by-param/{token}/{sheetNames}/{randomize?}', [SpreadsheetApiController::class, 'getDataByParam']);
Route::get('/get-media-by-token/{token}', [SpreadsheetApiController::class, 'getMediaByToken']);
Route::get('/get-media-by-param/{token}/{sheetNames}', [SpreadsheetApiController::class, 'getMediaByParam']);
Route::get('/get-dummy-test', [SpreadsheetApiController::class, 'getDummyQuestion']);
