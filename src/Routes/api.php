<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| WEB Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider
|
*/

Route::group(['prefix' => 'api', 'middleware' => 'api'], function () {
    Route::get('/poeditor/translation/upload', [\NextApps\PoeditorSync\Http\Controllers\TranslateController::class, 'send']);
    Route::get('/poeditor/translation/download', [\NextApps\PoeditorSync\Http\Controllers\TranslateController::class, 'download']);
});