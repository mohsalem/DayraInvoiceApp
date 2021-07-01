<?php

namespace App\Http\Controllers;

use App\Client;
use App\Invoice;
use App\Mail\invoice_email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'mobile' => 'nullable',
            'email' => 'required|email',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'client_id' => 'nullable|integer'
        ]);
        if (!isset($request->client_id))
        {
            $client = Client::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
            ]);
            $request->client_id = $client->id;
        }
        $invoice = Invoice::create([
            'user_id' => Auth::id(),
            'client_id' => $request->client_id,
            'amount' => $request->amount,
            'due_date' => $request->due_date,
        ]);

        try {
            Mail::to($invoice->client->email)->send(new invoice_email($invoice->client->full_name, $invoice->amount, $invoice->due_date));
        }catch (\Exception $e){
            Log::error($e);
        }

        return $invoice;

    }
}
