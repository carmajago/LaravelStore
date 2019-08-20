<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientPayment;
use App\Sale;

class ClientPaymentController extends Controller
{

    public function create($id)
    {
        return view("ClientPayments/create", ["clientId" => $id]);
    }

    public function store(Request $request)
    {

        $rq = request()->validate([
            'value' => 'required',
            'name' => 'required',
            'client_id' => 'required',
        ]);

        $sales = Sale::where('client_id', $rq['client_id'])
            ->where('total_credit', '!=', 0)->get();


        $credit = $rq['value'];
        foreach ($sales as $sale => $value) {
            if ($credit > 0) {
                if ($value['total_credit'] - $credit < 0) {
                    $credit = $credit - ($value['total_credit']);
                    $value['total_credit'] = 0;
                } else {
                    $value['total_credit'] = $value['total_credit'] - $credit;
                    $credit = 0;
                }

                $value->save();
            }
        }
        ClientPayment::create($rq);
        return redirect()->route('clients.show', $rq['client_id']);
    }
}
