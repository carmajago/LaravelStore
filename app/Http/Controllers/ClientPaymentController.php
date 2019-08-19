<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientPayment;

class ClientPaymentController extends Controller
{

    public function create($id)
    {
        return view("ClientPayments/create", ["clientId" => $id]);
    }

    public function store(Request $request)
    {
        $provider = request()->validate([
            'value' => 'required',
            'name' => 'required',
            'client_id' => 'required',
        ]);

        ClientPayment::create($provider);
        return redirect()->route('clients.show', $provider["client_id"]);
    }
}
