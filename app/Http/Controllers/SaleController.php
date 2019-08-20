<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Client;
use App\Product;
use App\ProductCategory;
use App\SalesDetail;
use App\salesDetail as AppSalesDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('Sales/index', [
            'sales' => Sale::with('client')->with('user')->latest()->paginate(5)
        ]);
    }

    public function findClient(Request $request)
    {
        $name = $request->input('name');
        $clients = Client::findName($name)->latest()->paginate(5);


        return view('Sales/create_step1', [
            'clients' =>  $clients,
        ]);
    }
    public function newClient(Request $request)
    {
        $client = request()->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'credit' => 'boolean',
        ]);

        $cc = Client::create($client);
        return view('Sales/create', ['client' => $cc]);
    }


    public function show($id)
    {

        $sale = Sale::with('client')->where('id', '=', $id)->first();
        $saleDetails = SalesDetail::with('product')->where('sale_id', '=', $id)->get();
        $products = Product::all();

        $neto = SalesDetail::where('sale_id', '=', $id)
            ->select(DB::raw('sum(price) as neto'))->first();

        $iva = SalesDetail::where('sale_id', '=', $id)
            ->select(DB::raw('sum(price*((iva/100)+1)) as iva'))->first();
        $total = SalesDetail::where('sale_id', '=', $id)
            ->select(DB::raw('sum(price*((iva/100)+1)*(1-(discount/100))) as total'))->first();


        return view('Sales/show', [
            'sale' => $sale,
            'saleDetails' => $saleDetails,
            'neto' => round($neto["neto"]),
            'iva' => round($iva["iva"]),
            'total' => round($total["total"])
        ]);
    }

    public function edit($id)
    {
        $sale = Sale::find($id);


        if (!$sale) {
            return "not Found";
        }

        return view('Sales/update', [
            'sale' => $sale,
            'roles' => Role::latest()->paginate()
        ]);
    }

    public function store(Request $request)
    {

        $sale = request()->validate([
            //'total_credit' => 'required',
            //'total_counted' => 'required',
            'client_id' => 'required',
        ]);

        $userId = Auth::id();
        $ss = new Sale;

        $ss->client_id = $sale['client_id'];
        $ss->user_id = $userId;
        $ss->total_credit = 0;
        $ss->total_counted = 0;
        $ss->save();
        $products = Product::all();
        return redirect()->route('sales.addProduct', $ss);
    }


    public function updateCredit()
    {
        $rq = request()->validate([
            'total_credit' => 'required',
            'sale_id' => 'required',
            //'client_id' => 'required',
        ]);

        $sale = Sale::find($rq['sale_id']);
        $saleDetails = SalesDetail::where('sale_id', '=', $rq['sale_id'])
            ->select(DB::raw('sum(price * (1+(iva/100)) * (1+(discount/100))) as total'))
            ->first();

        if ($rq['total_credit'] > $saleDetails['total']) {

            return Redirect::back()->withErrors(['Limte de crédito superado']);
        }
        $sale->total_credit = $rq['total_credit'];
        $sale->total_counted = ($saleDetails['total']) - $rq['total_credit'];
        $sale->save();
        return redirect()->route('sales.index');
    }

    public function addProduct($id)
    {


        $sale = Sale::with('client')->where('id', '=', $id)->first();
        $saleDetails = SalesDetail::with('product')->where('sale_id', '=', $id)->get();
        $products = Product::all();

        $neto = SalesDetail::where('sale_id', '=', $id)
            ->select(DB::raw('sum(price) as neto'))->first();

        $iva = SalesDetail::where('sale_id', '=', $id)
            ->select(DB::raw('sum(price*((iva/100)+1)) as iva'))->first();
        $total = SalesDetail::where('sale_id', '=', $id)
            ->select(DB::raw('sum(price*((iva/100)+1)*(1-(discount/100))) as total'))->first();
        return view(
            'Sales/create_step2',
            [
                'sale' => $sale,
                'products' => $products,
                'saleDetails' => $saleDetails,
                'neto' => round($neto["neto"]),
                'iva' => round($iva["iva"]),
                'total' => round($total["total"])
            ]
        );
    }

    public function storeProductDetail(Request $request)
    {

        // $discount = $request->input('discount');
        //$productId = $request->input('product_id');

        $pruductValidation = request()->validate([
            'product_id' => 'required',

        ]);

        $saleId = $request->input('sale_id');
        $product = Product::find($pruductValidation['product_id']);
        $quantity = $request->input('quantity');
        $sale = Sale::with('client')->where('id', '=', $saleId)->first();

        if ((intval($product["quantity_available"]) - intval($quantity)) < 0) {

            return Redirect::back()->withErrors(['No hay suficientes productos en stock']);
        }

        $product["quantity_available"] = intval($product["quantity_available"]) - intval($quantity);
        $product->save();

        $productDetails = new SalesDetail;
        $productDetails->discount =  $request->discount;
        $productDetails->quantity = $quantity;
        $productDetails->sale_id = $saleId;
        $productDetails->product_id = $pruductValidation['product_id'];
        $productDetails->iva = $product['iva'];
        $productDetails->price = $product['price'] * $quantity;

        $productDetails->save();

        return redirect()->route('sales.addProduct', $sale);
    }



    public function update(Request $request, $id)
    {
        $sale = Sale::find($id);

        if (!$sale) {
            return "not Found";
        }

        $rq = request()->validate([
            'role_id' => 'required',
            'email' => 'required',
        ]);
        $sale->name = $request->name;
        $sale->email = $request->email;
        $sale->role_id = $rq['role_id'];
        $sale->save();
        return redirect()->back()->with('message', 'Actualizado con éxito');
    }


    public function create($id)
    {

        $client = Client::find($id);
        return view('Sales/create', ['client' => $client]);
    }


    public function destroy($id)
    {

        Sale::findOrFail($id)->delete();
        return redirect()->route('sales.index');
    }
}
