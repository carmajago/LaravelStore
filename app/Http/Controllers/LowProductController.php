<?php

namespace App\Http\Controllers;

use App\Product;
use App\LowProduct;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class LowProductController extends Controller
{

    public function index()
    {

        $products = LowProduct::join('products', 'low_products.product_id', 'products.id')
            ->paginate(5);

        return view(
            'LowProducts/index',
            [
                'products' => $products,
            ]
        );
    }
    public function create($id)
    {

        $product = Product::find($id);

        return view(
            'LowProducts/create',
            [
                'product' => $product,
            ]
        );
    }


    public function store(Request $request)
    {

        $rq = request()->validate([
            'quantity' => 'required',
            'price' => 'required',
            'possible_low_rate' => 'required',
            'product_id' => 'required',
            'type' => 'required',
        ]);

        $product = Product::find($rq['product_id']);

        if ($product['quantity_available'] - $rq['quantity'] < 0) {
            return Redirect::back()->withErrors(['No hay suficientes productos en stock']);
        }
        $product['quantity_available'] =  $product['quantity_available'] - $rq['quantity'];
        $product->save();

        LowProduct::create($rq);
        return redirect()->route('products.index');
    }
}
