<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->roles == 'Admin') {
                notify()->success('Berhasil Login !');
                return redirect('admin/dashboard');
            }
        }else{
            notify()->warning('Login Gagal!');
            return redirect('/');
        }

    }

    public function logout(){
        Auth::logout();
        notify()->success('Berhasil Logout !');
        return redirect('admin/dashboard');
    }
}
