<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function __construct()
{
    $this->middleware('auth');
}

    public function index()
    {
        return view('Users/index',[
        'users' => User::with('role')->latest()->paginate(5)
        ]);

    }

    public function show($id)
    {
        $product = Product::find($id);

        return view('product', [ 'product' => $product]);
    }

    public function edit($id)
    {
        $product = Product::find($id);

        return view('EditProduct', [ 'product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->iva = $request->iva;
        $product->quantity_available = $request->quantity_available;
        $product->min_amount = $request->min_amount;
        $product->max_amount = $request->max_amount;
        $product->save();
        return redirect()->back()->with('message', 'Actualizado con éxito');

    }


    public function create()
    {

        return view('Users/create',[
        'roles' =>Role::latest()->paginate()
        ]);
    }


    public function store(Request $request) {
        
        $user = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role_id' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
      ]);

    if ($request->has('photo')) {
        // Get image file
        $folder = '/images';
        $image = $request->file('photo')->store($folder);
        $request->file('photo')->move(public_path('images'), $image);
        $user['photo']= $image;
        // Make a image name based on user name and current timestamp
    }   
        // $user['password'] = Hash::make($user['password']);
        User::create($user);
        return redirect()->route('users.index');
    }


    public function destroy($id){

        Product::findOrFail($id)->delete();
        return redirect()->route('products.index');
    }
}
