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
//    Route::resources([
//        'set' => App\Http\Controllers\AdminController::class,
//        'category' => App\Http\Controllers\CategoryController::class,
//        'company' => App\Http\Controllers\CompanyController::class,
//    ]);
     //   ->except('show');
    Route::resource('set', App\Http\Controllers\AdminController::class)
        ->except('show');
    Route::resource('category', App\Http\Controllers\CategoryController::class)
        ->except('show');
    Route::resource('company', App\Http\Controllers\CompanyController::class)
        ->except('show');
});

Route::prefix('/public')->group(function () {
    Route::resource('set', \App\Http\Controllers\PublicSetController::class)
        ->only([
        'index', 'show' ])
        ->names('public.set');
    Route::resource('category', \App\Http\Controllers\PublicCategoryController::class)
        ->only([
        'index', 'show' ])
        ->names('public.category');
    Route::resource('company', \App\Http\Controllers\PublicCompanyController::class)
        ->only([
        'index', 'show' ])
        ->names('public.company');
    });


