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
        $sale = Sale::find($id);

        return view('Sales/show', ['sale' => $sale]);
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
            'total_credit' => 'required',
            'total_counted' => 'required',
            'client_id' => 'required',
        ]);

        $userId = Auth::id();
        $sale['user_id'] = $userId;
        $ss = Sale::create($sale);

        $products = Product::all();
        return redirect()->route('sales.addProduct', $ss);
    }


    public function addProduct($id)
    {


        $sale = Sale::find($id);
        $saleDetails = SalesDetail::with('product')->where('sale_id', '=', $id)->get();
        $products = Product::all();
        return view(
            'Sales/create_step2',
            [
                'sale' => $sale,
                'products' => $products,
                'saleDetails' => $saleDetails,
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

        $productDetails = new SalesDetail;
        $productDetails->discount =  $request->discount;
        $productDetails->quantity = $quantity;
        $productDetails->sale_id = $saleId;
        $productDetails->product_id = $pruductValidation['product_id'];
        $productDetails->iva = $product['iva'];
        $productDetails->price = $product['price'] * $quantity;

        $productDetails->save();

        $sale = Sale::find($saleId);
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
