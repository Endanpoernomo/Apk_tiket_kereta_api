<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view("user.index", [
            "users" => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah_users()
    {
        return view("user.tambah");
    }

    public function proses_tambah_users(Request $request)
    {
        //unique:users adalah pengecekan kalau semisal ada email yg sama ya gk boleh
        $user = $request->validate([
            "name" => "required",
            "email" => "required|unique:users",
            "password" => "required",
        ]);

        //ubah password yg tadinya cuma text biasa jadi bcrypt alias hashed
        $user["password"] = bcrypt($user["password"]);

        if (User::create($user)) {
            return redirect()->to("/users")->with("success", "Berhasil menambah user");
        }
        return redirect()->to("/users")->with("error", "Gagal menambah user");
    }

    public function show(User $user)
    {
        //
    }

    public function edit_users(User $user)
    {
        return view("user.edit", [
            "user" => $user
        ]);
    }

    public function proses_edit_users(Request $request, User $user)
    {
        //cari customers dengan email yg sama di update form
        $cariUser = User::where("email", $request->email)->first();

        //cek dulu apakah ada duplikat ya biar login ya gk error, cek customer yg dicari email y sama atau enggak sama yg di customer di update, kalo email nya beda berarti duplikat
        if ($cariUser && $cariUser->email != $user->email) {
            return back()->with("error", "Email sudah ada");
        }

        $updateUser = $request->validate([
            "name" => "required",
            "email" => "required",
        ]);

        //ubah password yg tadinya cuma text biasa jadi bcrypt alias hashed kalau password ya mau diubah
        if ($request->password) {
            $updateUser["password"] = bcrypt($request->password);
        }

        if ($user->update($updateUser)) {
            return redirect()->to("/users")->with("success", "Berhasil update $user->name");
        }
        return redirect()->to("/users")->with("error", "Gagal update $user->name");
    }

    public function proses_hapus_users(User $user)
    {
        if ($user->delete()) {
            return back()->with("success", "Berhasil menghapus user $user->name");
        }
        return back()->with("gagal", "Gagal menghapus user $user->name");
    }
}
