<?php

namespace App\Http\Controllers;

use App\Models\Stasiun;
use Illuminate\Http\Request;

class StasiunController extends Controller
{
    public function index()
    {
        return view("stasiun.index", [
            "stations" => Stasiun::all()
        ]);
    }

    public function tambah_stasiun()
    {
        return view("stasiun.tambah");
    }

    public function proses_tambah_stasiun(Request $request)
    {
        $stasiun = $request->validate([
            "station_code" => "required",
            "station_name" => "required",
            "city" => "required",
        ]);

        if (Stasiun::create($stasiun)) {
            return redirect()->to("/stasiun")->with("success", "Berhasil menambahkan stasiun");
        }
        return redirect()->to("/stasiun")->with("error", "Gagal menambahkan stasiun");
    }

    public function show(Stasiun $stasiun)
    {
        //
    }

    public function edit_stasiun(Stasiun $stasiun)
    {
        return view("stasiun.edit", [
            "stasiun" => $stasiun
        ]);
    }

    public function proses_edit_stasiun(Request $request, Stasiun $stasiun)
    {
        $updateStasiun = $request->validate([
            "station_code" => "required",
            "station_name" => "required",
            "city" => "required",
        ]);

        if ($stasiun->update($updateStasiun)) {
            return redirect()->to("/stasiun")->with("success", "Berhasil mengubah stasiun");
        }
        return redirect()->to("/stasiun")->with("error", "Gagal mengubah stasiun");
    }

    public function proses_hapus_stasiun(Stasiun $stasiun)
    {
        if ($stasiun->delete()) {
            return back()->with("success", "Berhasil menghapus stasiun $stasiun->name");
        }
        return back()->with("error", "Gagal menghapus stasiun $stasiun->name");
    }
}
