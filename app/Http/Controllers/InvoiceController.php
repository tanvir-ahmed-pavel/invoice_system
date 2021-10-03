<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Driver;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Client;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;




class InvoiceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();

        return view("invoices.manage-invoice")->with([
            "invoices" => $invoices->load('client', 'company'),
        ]);

    }

    public function index_api(Request $request){
//        return $request->inputs[1]->dd();
        $invoices = Invoice::where(function($query) use($request){
            if($request->inputs && $request->inputs[1]['value']!= null){
                foreach ($request->inputs as $key=>$value){
                    if ($value['operator']=='like' || $value['operator']=='not like'){
                        $query->orWhere($value['column'], $value['operator'], '%'.$value['value'].'%')->get();
                    } else {
                        $query->orWhere($value['column'], $value['operator'], $value['value'])->get();
                    }
                }
            } else{
                $query->get();
            }
        })->get();
        $columns = Schema::getColumnListing('invoices');
        $invoices->load('client', 'company');

        return response()->json([
            'invoices'=>$invoices,
            'columns'=>$columns
        ], 200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $drivers = Driver::all();
        $clients = Client::all();
        $companies = Company::all();

        return view("invoices.new-invoice")->with([
            "drivers" => $drivers,
            "clients" => $clients,
            "companies" => $companies,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $this->validate($request, [
            "invoice_type" => 'required|string',
            "driver_id" => 'nullable',
            "client_id" => 'nullable',
            "company_id" => 'nullable',
            "car_details" => 'nullable',
            "tax" => 'nullable',
            "vat" => 'nullable',
            "sub_total" => 'required',
            "net_amount" => 'required',
            "discount" => 'nullable',
            "advance_paid" => 'nullable',
            "date" => 'nullable',
            "items.*.description" => 'required|string',
            "items.*.rate" => 'required',
            "items.*.amount" => 'required',
        ]);

        $subject = "Invoice for " . $data['invoice_type'] . " Basis Rental";

        $user = Auth::user();

//        Getting the Relationship Model

        if ($data['driver_id']){
            $driver= Driver::findOrFail($data['driver_id']);
        }
        if ($data['company_id']){
            $company= Company::findOrFail($data['company_id']);
        }
        if ($data['client_id']){
            $client= Client::findOrFail($data['client_id']);
        }


//        Creating Invoice

            $invoice = $user->invoices()->create([
                'invoice_signature' => (string)Str::uuid(),
                'discount' => $data['discount'],
                'invoice_type' => $data['invoice_type'],
                'subject' => $subject,
                'car_details' => $data['car_details'],
                'tax' => $data['tax'],
                'vat' => $data['vat'],
                'sub_total' => $data['sub_total'],
                'net_amount' => $data['net_amount'],
                'advance_paid' => $data['advance_paid'],
                'date' => $data['date'],
            ]);

//            Creating Invoice number


            $invoice->invoice_number = $this->generate_invoiceNumber($data['company_id']?$company:null, $data['client_id']?$client:null, $data['date'], $invoice->id);

//        Attaching Relationship

        if ($data['driver_id']){
            $invoice->driver()->associate($driver);
        }
        if ($data['company_id']){
            $invoice->company()->associate($company);
        }
        if ($data['client_id']){
            $invoice->client()->associate($client);
        }

        $invoice->save();

//         Creating Items

        foreach ($request->items as $item) {
            $invoice->items()->create([
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit' => $item['unit'],
                'rate' => $item['rate'],
                'amount' => $item['amount'],
            ]);
        }

        return response()->json($invoice->invoice_number,200);
//        return redirect()->route('invoices.show', $invoice->invoice_number);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($invoice_number)
    {
        $invoice = Invoice::where('invoice_number', $invoice_number)->firstOrFail();
        return view('invoices.show-invoice')->with([
            'invoice' => $invoice->load('items', 'driver', 'client', 'company', 'user')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {

            $invoice->delete();
            return response()->json('Invoice Deleted', 200);

    }

    //        Helper Method for Generating Invoice Number

    public function generate_invoiceNumber($company, $client, $date, $id){
        $client_slug = "";
        $company_slug = "";

        $dateDiv = explode('-', $date);
        $date_slug = $dateDiv[2] . $dateDiv[1]. (substr($dateDiv[0], -2, 2));

        if ($company!=null) {
            $companyDiv = explode(" ", $company->company_name);
            foreach ($companyDiv as $piece) {
                $company_slug = $company_slug . strtoupper($piece[0]);
            }
        }
        if ($client!=null) {
            $clientDiv = explode(" ", $client->client_name);
            foreach ($clientDiv as $piece) {
                $client_slug = $client_slug . strtoupper($piece[0]);
            }
        }

        return ($company_slug ? $company_slug : '0') . $date_slug . ($client_slug ? $client_slug: '0') . $id;
    }

    function printInvoice($id) {
        $invoice =Invoice::where('invoice_number', $id)->firstOrFail();
        $data['invoice'] = $invoice->load('items', 'driver', 'client', 'company', 'user');
        $pdf = SnappyPdf::loadView('invoices.print-invoice', $data);
        return $pdf->stream('inv_'.$invoice->invoice_number.'.pdf');

//        return $pdf->stream('inv_'.$invoice->invoice_number.'.pdf');
    }

    function downloadInvoice($id) {
        $invoice =Invoice::where('invoice_number', $id)->firstOrFail();
        $data['invoice'] = $invoice->load('items', 'driver', 'client', 'company', 'user');
        $pdf = SnappyPdf::loadView('invoices.print-invoice', $data);
        return $pdf->download('inv_'.$invoice->invoice_number.'.pdf');

//        return $pdf->stream('inv_'.$invoice->invoice_number.'.pdf');
    }

}
