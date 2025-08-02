<?php

namespace App\Http\Controllers;

use App\Models\Fare;
use App\Models\Journeys;
use Illuminate\Http\Request;

class FareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // with(["kereta.kereta"]) maksudnya kita manggil 2 relationship sekaligus
        // di model Fare kita panggil relationship namanya kereta(), nah kan relasi ya ke Journeys::class tuh,
        // nah di Journeys::class kan ada relationship ke kereta namanya kereta() juga makanya kita chaining di sini
        return view("fare.index", [
            // groupBy buat bikin semua data yg value train_no ya sama dijadiin 1. nanti keluarnya bakal 1 data kalo ada 3 kelas yg udah di atur tarif nya
            // nanti bisa liat detail tarif ya di show detail
            "journeys" => Journeys::with(["kereta"])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah_fare($code)
    {
        return view("fare.tambah", [
            "journey" => Journeys::with(["kereta"])->where("train_no", $code)->first()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFareRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function proses_tambah_fare(Request $request)
    {
        $tarif = $request->validate([
            "train_no" => "required",
            "class" => "required",
            "fare" => "required"
        ]);
        //cek dulu kalo harga kelas kereta ya udah di atur sebelumnya
        $cariKelas = Fare::where("train_no", $request->train_no)->where("class", $request->class)->first();
        if ($cariKelas) {
            return back()->with("error", "Harga kelas kereta sudah ada");
        }

        if (Fare::create($tarif)) {
            return redirect()->to("fare/detail/$request->train_no")->with("success", "Berhasil menetapkan tarif kereta");
        }
        return back()->with("error", "Gagal menetapkan tarif kereta");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fare  $fare
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        return view("fare.detail", [
            "journey" => Journeys::with(["fare", "kereta"])->where("train_no", $code)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fare  $fare
     * @return \Illuminate\Http\Response
     */
    public function edit(Fare $fare)
    {
        return view("fare.edit", [
            "fare" => $fare
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFareRequest  $request
     * @param  \App\Models\Fare  $fare
     * @return \Illuminate\Http\Response
     */
    public function proses_edit_fare(Request $request, Fare $fare)
    {
        $tarif = $request->validate([
            "class" => "required",
            "fare" => "required"
        ]);

        if ($fare->update($tarif)) {
            return redirect()->to("fare/detail/$fare->train_no")->with("success", "Berhasil mengubah tarif kereta");
        }
        return back()->with("error", "Gagal mengubah tarif kereta");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fare  $fare
     * @return \Illuminate\Http\Response
     */
    public function proses_hapus_fare(Fare $fare)
    {
        if ($fare->delete()) {
            return back()->with("success", "Berhasil menghapus tarif kereta");
        }
        return back()->with("success", "Berhasil menghapus tarif kereta");
    }
}
