<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientPayment;
use App\Sale;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $name = $request->input('name');
        $clients = Client::findName($name)->latest()->paginate(5);


        return view('Clients/index', [
            'clients' =>  $clients,
        ]);
    }


    public function show($id)
    {
        $client = Client::find($id);
        $sales = Sale::where("client_id", "=", $id)->paginate(5);
        $payments = ClientPayment::where("client_id", "=", $id)->paginate(5);
        $totalCredit = Sale::where('client_id', '=', $id)
            ->select(DB::raw('sum(total_credit) as total'))
            ->first();

        return view('Clients/show', [
            'client' => $client,
            'sales' => $sales,
            'payments' => $payments,
            'credit' => $totalCredit['total'],
        ]);
    }


    public function create()
    {
        return view(
            'Clients/create'
        );
    }


    public function store(Request $request)
    {

        $provider = request()->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);


        Client::create($provider);
        return redirect()->route('clients.index');
    }

    public function destroy($id)
    {

        Client::findOrFail($id)->delete();
        return redirect()->route('clients.index');
    }
}
