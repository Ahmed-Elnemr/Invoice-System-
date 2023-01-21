<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Invoice_Details;
use App\Models\Invoice_attachments;
use Illuminate\Support\Facades\Storage;

class InvoiceDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice_Details  $invoice_Details
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice_Details $invoice_Details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice_Details  $invoice_Details
     * @return \Illuminate\Http\Response
     */
    public function edit( $InvoicesDetails)
    {
        $invoices = Invoice::where('id',$InvoicesDetails)->first();
        $details  = Invoice_Details::where('id_Invoice',$InvoicesDetails)->get();
        $attachments  = invoice_attachments::where('invoice_id',$InvoicesDetails)->get();

        return view('invoices.details_invoice',compact('invoices','details','attachments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice_Details  $invoice_Details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice_Details $invoice_Details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice_Details  $invoice_Details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoices = Invoice_attachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }

    public function get_file($invoice_number, $file_name)

    {
        $contents = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->download($contents);
    }



    public function open_file($invoice_number, $file_name)

    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->file($files);
    }
}
