<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutentikasiController extends Controller
{
    public function login() {
        return view("login");
    }

    public function proses_login(Request $request) {
        $login = $request->validate([
            "email" => "required",
            "password" => "required"
        ]);
        
        if (Auth::attempt($login)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }

        return back()->with("error", "Tidak ada akun ditemukan!");
    }

    public function loginCustomer() {
        return view("loginCustomer");        
    }

    public function proses_login_customer(Request $request) {
        $login = $request->validate([
            "email" => "required",
            "password" => "required"
        ]);
        
        if (Auth::guard("customer")->attempt($login)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/dasboard');
        }

        return back()->with("error", "Tidak ada akun ditemukan!");
    }

    public function registerCustomer() {
        return view("registerCustomer");
    }

    public function proses_register_customer(Request $request) {
        $customer = $request->validate([
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "city" => "required",
            "country" => "required",
        ]);

        $customer["password"] = bcrypt($customer["password"]);

        if (Customers::create($customer)) {
            return redirect()->to("/customers/login")->with("success", "Berhasil membuat akun, silahkan login");
        }
        return redirect()->to("/customers/register")->with("error", "Gagal membuat akun, coba lagi");
    }

    public function proses_logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login')->with("success", "Berhasil logout");
    }

}
