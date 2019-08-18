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
        return view('Users/index', [
            'users' => User::with('role')->latest()->paginate(5)
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);

        return view('Users/show', ['user' => $user]);
    }

    public function edit($id)
    {
        $user = User::find($id);


        if (!$user) {
            return "not Found";
        }

        return view('Users/update', [
            'user' => $user,
            'roles' => Role::latest()->paginate()
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return "not Found";
        }

        $rq = request()->validate([
            'role_id' => 'required',
            'email' => 'required',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $rq['role_id'];
        $user->save();
        return redirect()->back()->with('message', 'Actualizado con éxito');
    }


    public function create()
    {

        return view('Users/create', [
            'roles' => Role::latest()->paginate()
        ]);
    }


    public function store(Request $request)
    {

        $user = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'role_id' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->has('photo')) {
            // Get image file
            $folder = '/images';
            $image = $request->file('photo')->store($folder);
            $request->file('photo')->move(public_path('images'), $image);
            $user['photo'] = $image;
            // Make a image name based on user name and current timestamp
        }
        // $user['password'] = Hash::make($user['password']);
        User::create($user);
        return redirect()->route('users.index');
    }


    public function destroy($id)
    {

        User::findOrFail($id)->delete();
        return redirect()->route('users.index');
    }
}
