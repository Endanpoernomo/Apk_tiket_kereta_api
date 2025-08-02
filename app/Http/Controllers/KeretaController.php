<?php

namespace App\Http\Controllers;

use App\Models\Kereta;
use Illuminate\Http\Request;

class KeretaController extends Controller
{
    public function index()
    {
        //return view dengan data trains diambil dari Kereta::all alias semua data kereta
        return view("kereta.index", [
            "trains" => Kereta::all()
        ]);
    }

    public function tambah_kereta()
    {
        return view("kereta.tambah");
    }

    public function proses_tambah_kereta(Request $request)
    {
        //validasi dulu form nya. kalo udah masukin ke variable $kereta;
        $kereta = $request->validate([
            "train_name" => "required",
            "eco_seat_num" => "required",
            "busines_seat_num" => "required",
            "exec_seat_num" => "required"
        ]);

        //abis itu lgsng buat dengan data yg udah di validasi. karena name dari input ya sama kaya di database jadinya bisa lgsng masuk
        if (Kereta::create($kereta)) {
            return redirect()->to("/kereta")->with("success", "Berhasil menambahkan kereta baru");
        }
        return redirect()->to("/kereta")->with("error", "Gagal menambahkan kereta baru");
    }

    public function show(Kereta $kereta)
    {
        //
    }

    public function edit_kereta(Kereta $kereta)
    {
        //route model binding tadi jadinya lgsng nyari kereta dengan id yg sama. trus lgsng kita taro aja di view datanya
        return view("kereta.edit", [
            "kereta" => $kereta
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKeretaRequest  $request
     * @param  \App\Models\Kereta  $kereta
     * @return \Illuminate\Http\Response
     */
    public function proses_edit_kereta(Request $request, Kereta $kereta)
    {
        //validasi dulu keretanya
        $updateKereta = $request->validate([
            "train_name" => "required",
            "eco_seat_num" => "required",
            "busines_seat_num" => "required",
            "exec_seat_num" => "required"
        ]);

        // lgsng update 
        if ($kereta->update($updateKereta)) {
            return redirect()->to("/kereta")->with("success", "Berhasil update kereta baru");
        }
        return redirect()->to("/kereta")->with("error", "Gagal update kereta baru");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kereta  $kereta
     * @return \Illuminate\Http\Response
     */
    public function proses_hapus_kereta(Kereta $kereta)
    {
        //udah di panggil modelnya. lgsng cari data nya. trus hapus
        if ($kereta->delete()) {
            $relasi = Kereta::where("id_train", $kereta->id)->get();
            $relasi->each(function($journeys) {
                Route::where("train_no", $journeys->train_no)->delete();
                Fare::where("train_no", $journeys->train_no)->delete();
                DetailBooking::where("train_no", $journeys->train_no)->booking()->delete();
                DetailBooking::where("train_no", $journeys->train_no)->kursi()->delete();
                DetailBooking::where("train_no", $journeys->train_no)->delete();
            });
            return back()->with("success", "Berhasil menghapus kereta $kereta->train_name");
        }
        return back()->with("error", "Gagal menghapus kereta $kereta->train_name");
    }
}
