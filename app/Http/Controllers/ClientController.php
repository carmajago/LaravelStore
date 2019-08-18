<?php

namespace App\Http\Controllers;

use App\Client;

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

        return view('Clients/show', ['client' => $client]);
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
