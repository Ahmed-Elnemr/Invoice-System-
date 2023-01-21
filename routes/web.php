<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceDetailsController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ProductController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('invoices', InvoiceController::class);
Route::resource('sections', SectionController::class);
Route::resource('products', ProductController::class);
Route::get('section/{section}', [InvoiceController::class, 'getProducts']);
Route::get('InvoicesDetails/{InvoicesDetails}', [InvoiceDetailsController::class, 'edit'])->name('invoices.details.edite');
Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'get_file']);
Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'open_file']);
Route::post('delete_file', [InvoicesDetailsController::class,'destroy'])->name('delete_file');

// Route::get('/edit_invoice/{id}', 'InvoicesController@edit');

// {{ route('invoices.details.edite',['InvoicesDetails'=>$invoice->id] )}}



Route::get('/{page}', [AdminController::class,'index']);
