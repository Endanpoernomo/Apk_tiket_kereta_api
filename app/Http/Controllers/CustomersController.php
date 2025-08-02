<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {
        return view("customers.index", [
            "customers" => Customers::all()
        ]);
    }

    public function tambah_customers()
    {
        return view("customers.tambah");
    }

    public function proses_tambah_customers(Request $request)
    {
        //unique:customers adalah pengecekan kalau semisal ada email yg sama ya gk boleh
        $customers = $request->validate([
            "name" => "required",
            "email" => "required|unique:customers",
            "password" => "required",
            "city" => "required",
            "country" => "required",
        ]);

        //ubah password yg tadinya cuma text biasa jadi bcrypt alias hashed
        $customers["password"] = bcrypt($customers["password"]);

        if (Customers::create($customers)) {
            return redirect()->to("/customers")->with("success", "Berhasil menambah customers");
        }
        return redirect()->to("/customers")->with("error", "Gagal menambah customers");
    }

    public function show(Customers $customers)
    {
        //
    }

    public function edit_customers(Customers $customers)
    {
        return view("customers.edit", [
            "customer" => $customers
        ]);
    }

    public function proses_edit_customers(Request $request, Customers $customers)
    {
        //cari customers dengan email yg sama di update form
        $cariCustomer = Customers::where("email", $request->email)->first();

        //cek dulu apakah ada duplikat ya biar login ya gk error, cek customer yg dicari email y sama atau enggak sama yg di customer di update, kalo email nya beda berarti duplikat
        if ($cariCustomer && $cariCustomer->email != $customers->email) {
            return back()->with("error", "Email sudah ada");
        }

        $updateCustomer = $request->validate([
            "name" => "required",
            "email" => "required",
            "city" => "required",
            "country" => "required",
        ]);

        //ubah password yg tadinya cuma text biasa jadi bcrypt alias hashed kalau password ya mau diubah
        if ($request->password) {
            $updateCustomer["password"] = bcrypt($request->password);
        }

        if ($customers->update($updateCustomer)) {
            return redirect()->to("/customers")->with("success", "Berhasil update $customers->name");
        }
        return redirect()->to("/customers")->with("error", "Gagal update $customers->name");
    }

    public function proses_hapus_customers(Customers $customers)
    {
        if ($customers->delete()) {
            return redirect()->to("/customers")->with("success", "Berhasil menghapus customer $customers->name");
        }
        return redirect()->to("/customers")->with("error", "Gagal menghapus customer $customers->name");
    }
}
