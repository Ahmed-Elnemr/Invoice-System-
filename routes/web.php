<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\InvoiceDetailsController;
use App\Http\Controllers\InvoiceAttachmentsController;


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

// InvoiceDetailsController 
Route::controller(InvoiceDetailsController::class)->group(function () {
    Route::get('InvoicesDetails/{InvoicesDetails}', 'edit')->name('invoices.details.edite');
    Route::get('viewFile/{invoice_number}/{file_name}' ,'view_file')->name('view.invoice.file');
    Route::get('downloadFile/{invoice_number}/{file_name}', 'download_file')->name('download.invoice.file');
    Route::post('deleteFile',  'destroy')->name('delete.invoice.file');
});
////////////////////////////////////////////////////////////////

// InvoiceAttachmentsController
Route::resource('InvoiceAttachments', InvoiceAttachmentsController::class);
////////////////////////////////////////////////////////////////
Route::get('editInvoice/{invoice}',[InvoiceController::class,'edit'])->name('edite.invoice');
Route::get('/statusShow/{invoice_statue}',[InvoiceController::class,'show'])->name('status.show');

Route::post('/Status_Update/{id}', [InvoiceController::class,'Status_Update'])->name('Status_Update');

Route::resource('Archive', InvoiceAchiveController::class);

Route::get('Invoice_Paid',[InvoiceController::class,'Invoice_Paid'])->name('invoice_paid');

Route::get('Invoice_UnPaid',[InvoiceController::class,'Invoice_UnPaid'])->name('invoice_unPaid');

Route::get('Invoice_Partial',[InvoiceController::class,'showInvoice_Partial'])->name('showInvoice_partial');

    Route::get('Print_invoice/{invoice}' ,[InvoiceController::class,'Print_invoice']);

Route::get('/{page}', [AdminController::class, 'index']);