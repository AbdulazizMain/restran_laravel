<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view("admin_login.login");
    }


    public function check_login(Request $request){
        $user = User::where('email','=',$request->email)
           ->first();
        if($user != null && Hash::check($request->password,$user->password)){
            Auth::login($user);
            return redirect('/admin/product');
        }
        return redirect('/admin');
    }
    public function addi(){
        $data = new User;
        $data->email = "admin@gmail.com";
        $data->password = bcrypt("admin");
        $data->save();
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
