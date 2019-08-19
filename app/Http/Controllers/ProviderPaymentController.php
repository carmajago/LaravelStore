<?php

namespace App\Http\Controllers;

use App\provider;
use Illuminate\Http\Request;
use App\ProviderPayment;

class ProviderPaymentController extends Controller
{
    public function create($id)
    {
        return view('ProvidersPayments/create', ['providerId' => $id]);
    }


    public function store(Request $request)
    {

        $provider = request()->validate([
            'value' => 'required',
            'provider_id' => 'required',
        ]);

        ProviderPayment::create($provider);
        return redirect()->route('providers.show', $provider["provider_id"]);
    }
}
