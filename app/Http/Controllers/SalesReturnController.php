<?php

namespace App\Http\Controllers;

use App\SalesReturn;
use App\SalesDetail;
use App\Product;
use App\SalesReturnDetail;
use Illuminate\Http\Request;

class SalesReturnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($id)
    {


        $saleDetail = SalesReturn::where('sale_id', '=', $id)->first();
        if (!$saleDetail) {
            $saleDetail = new SalesReturn;
            $saleDetail->sale_id = $id;
            $saleDetail->save();
        }
        $salereturn = SalesReturnDetail::where('sales_return_id', '=', $saleDetail['id'])
            ->join('products', 'sales_return_details.product_id', 'products.id')->get();

        $saleDetails = SalesDetail::with('product')->where('sale_id', '=', $id)->get();
        return view('SalesReturn/create', [
            'saleReturnId' => $saleDetail['id'],
            'saleReturn' => $salereturn,
            'products' => $saleDetails
        ]);
    }

    public function store()
    {


        $rq = request()->validate([
            'sales_return_id' => 'required',
            'product_id' => 'required',
            'product_quantity' => 'required',
        ]);


        // TODO restricciones 
        $product = Product::where('id', '=', $rq['product_id'])->first();

        $product->quantity_available = $product['quantity_available'] + $rq['product_quantity'];
        $product->save();

        SalesReturnDetail::create($rq);

        return redirect()->back()->with('message', 'Actualizado con éxito');
    }
}
