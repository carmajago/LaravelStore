<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\ProductPresentation;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('Products/index', [
            'products' => Product::latest()->paginate(5)
        ]);
    }

    public function show($id)
    {
        $product = Product::find($id);

        return view('Products/show', ['product' => $product]);
    }

    public function edit($id)
    {
        $product = Product::find($id);


        if (!$product) {
            return "not Found";
        }

        return view('Products/update', [
            'product' => $product,
            'roles' => Role::latest()->paginate()
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return "not Found";
        }

        $rq = request()->validate([
            'role_id' => 'required',
            'email' => 'required',
        ]);
        $product->name = $request->name;
        $product->email = $request->email;
        $product->role_id = $rq['role_id'];
        $product->save();
        return redirect()->back()->with('message', 'Actualizado con éxito');
    }


    public function create()
    {

        $productCategories = ProductCategory::all();
        $productPresentations = ProductPresentation::all();
        return view(
            'Products/create',
            [
                'product_categories' => $productCategories,
                'product_presentations' => $productPresentations
            ]
        );
    }


    public function store(Request $request)
    {

        $product = request()->validate([
            'name' => 'required',
            'price' => 'required',
            'iva' => 'required',
            'quantity_available' => 'required',
            'minimum_quantity' => 'required',
            'maximum_quantity' => 'required',
            'product_presentation_id' => 'required',
            'product_category_id' => 'required'
        ]);


        Product::create($product);
        return redirect()->route('products.index');
    }


    public function destroy($id)
    {

        Product::findOrFail($id)->delete();
        return redirect()->route('products.index');
    }
}