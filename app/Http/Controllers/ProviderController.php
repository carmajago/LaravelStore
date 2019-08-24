<?php

namespace App\Http\Controllers;

use App\Provider;
use App\ProviderPayment;

use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('Providers/index', [
            'providers' => Provider::latest()->paginate(5)
        ]);
    }
    public function show($id)
    {


        $provider = Provider::find($id);
        $providerPayments = ProviderPayment::where("provider_id", "=", $id)->paginate(5);


        return view('Providers/show', [
            'provider' => $provider,
            'providerPayments' => $providerPayments
        ]);
    }


    public function create()
    {

        return view(
            'Providers/create'
        );
    }


    public function store(Request $request)
    {

        $provider = request()->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);


        Provider::create($provider);
        return redirect()->route('providers.index');
    }

    public function destroy($id)
    {

        Provider::findOrFail($id)->delete();
        return redirect()->route('providers.index');
    }
}
