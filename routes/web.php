<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::prefix('/admin')->middleware('auth')->group(function () {

    Route::redirect('/', 'admin/company');
    Route::resource('set', App\Http\Controllers\Admin\SetController::class)
        ->except('show');
    Route::resource('category', App\Http\Controllers\Admin\CategoryController::class)
        ->except('show');
    Route::resource('company', App\Http\Controllers\Admin\CompanyController::class)
        ->except('show');
});

    Route::get('/{company:slug}/{category:slug}/{nestedCategory:slug}/{set:slug}', [\App\Http\Controllers\CatalogController::class, 'set'])->name('public.set.index');;
    Route::get('/{company:slug}/{category:slug}/{nestedCategory:slug}', [\App\Http\Controllers\CatalogController::class, 'nestedCategory'])->name('public.nestedCategory.index');
    Route::get('/{company:slug}/{category:slug}', [\App\Http\Controllers\CatalogController::class, 'parentCategory'])->name('public.category.index');
    Route::get('/{company:slug}', [\App\Http\Controllers\CatalogController::class, 'company'])->name('public.company.index');

Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('main.index');

