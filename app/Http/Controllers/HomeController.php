<?php

namespace App\Http\Controllers;

use App\SalesDetail;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        $products = SalesDetail::join('products', 'sales_details.product_id', 'products.id')
            ->groupBy('product_id')
            ->orderBy('total', 'desc')
            ->select('products.*', DB::raw('sum(quantity) as total ,product_id'))
            ->paginate(5);

        //Menos vendidos
        $products2 = SalesDetail::join('products', 'sales_details.product_id', 'products.id')
            ->groupBy('product_id')
            ->orderBy('total', 'asc')
            ->select('products.*', DB::raw('sum(quantity) as total ,product_id'))
            ->paginate(5);
        $products3 = Product::orderBy('quantity_available', 'asc')->paginate(5);
        return view('home', [
            'products' => $products,
            'products2' => $products2,
            'products3' => $products3
        ]);
    }
}
