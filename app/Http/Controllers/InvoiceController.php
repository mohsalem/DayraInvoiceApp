<?php

namespace App\Http\Controllers;

use App\Client;
use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return $invoice;

    }
}
