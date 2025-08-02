<?php

namespace App\Http\Controllers;

use App\Models\Journeys;
use App\Models\DetailBooking;
use App\Models\Kereta;
use App\Models\Stasiun;
use App\Models\Fare;
use App\Models\Route;
use Illuminate\Http\Request;

class JourneysController extends Controller
{
    public function index()
    {
        //karena ada relasi pake with buat bawa semua relasi nya juga
        return view("journeys.index", [
            "journeys" => Journeys::with(["kereta", "keberangkatan", "kedatangan"])->get()
        ]);
    }

    public function tambah_journeys()
    {
        return view("journeys.tambah", [
            "trains" => Kereta::all(),
            "stations" => Stasiun::all()
        ]);
    }

    public function proses_tambah_journeys(Request $request)
    {
        $journeys = $request->validate([
            "id_train" => "required",
            "train_no" => "required",
            "depart_station" => "required",
            "arrival_station" => "required",
            "depart_time" => "required",
            "arrival_time" => "required",
        ]);

        //cek kalo ada code train yg sama biar gk tabrakan sama yg lain
        $cariKereta = Journeys::where("train_no", $request->train_no)->first();
        if ($cariKereta) {
            return back()->with("error", "Kode kereta sudah dipakai!");
        }

        //cek kalo berangkat sama kedatangan sama aja ya gk boleh
        if ($request->depart_station == $request->arrival_station) {
            return back()->with("error", "Keberangkatan dan Kedatangan tidak boleh sama");
        }

        if (Journeys::create($journeys)) {
            Route::create([
                "train_no" => $journeys["train_no"],  
                "start_route" => $journeys["depart_station"],  
                "end_route" => $journeys["arrival_station"],  
                "route_seq" => "",
                "depart_time" => $journeys["depart_time"],  
                "arrival_time" => $journeys["arrival_time"],  
            ]);          
            return redirect()->to("/journeys")->with("success", "Berhasil menambahkan perjalanan kereta baru");
        }
        return redirect()->to("/journeys")->with("error", "Gagal menambahkan perjalanan kereta baru");
    }

    public function show(Journeys $journeys)
    {
        //
    }

    public function edit_journeys(Journeys $journeys)
    {
        return view("journeys.edit", [
            "journey" => $journeys,
            "trains" => Kereta::all(),
            "stations" => Stasiun::all()
        ]);
    }

    public function proses_edit_journeys(Request $request, Journeys $journeys)
    {
        $updateJourneys = $request->validate([
            "id_train" => "required",
            "train_no" => "required",
            "depart_station" => "required",
            "arrival_station" => "required",
            "depart_time" => "required",
            "arrival_time" => "required",
        ]);

        //cek kalo ada code train yg sama biar gk tabrakan sama yg lain
        $cariKereta = Journeys::where("train_no", $request->train_no)->first();
        if ($cariKereta && $cariKereta->train_no != $journeys->train_no) {
            return back()->with("error", "Kode kereta sudah dipakai!");
        }

        //cek kalo berangkat sama kedatangan sama aja ya gk boleh
        if ($request->depart_station == $request->arrival_station) {
            return back()->with("error", "Keberangkatan dan Kedatangan tidak boleh sama");
        }

        if ($journeys->update($updateJourneys)) {
            Route::where("train_no", $journeys->train_no)->update([
                "train_no" => $updateJourneys["train_no"],  
                "start_route" => $updateJourneys["depart_station"],  
                "end_route" => $updateJourneys["arrival_station"],  
                "route_seq" => "",
                "depart_time" => $updateJourneys["depart_time"],  
                "arrival_time" => $updateJourneys["arrival_time"],  
            ]); 
            return redirect()->to("/journeys")->with("success", "Berhasil mengubah perjalanan kereta");
        }
        return redirect()->to("/journeys")->with("error", "Gagal mengubah perjalanan kereta");
    }

    public function proses_hapus_journeys(Journeys $journeys)
    {
        if ($journeys->delete()) {
            Route::where("train_no", $journeys->train_no)->delete();
            Fare::where("train_no", $journeys->train_no)->delete();
            DetailBooking::where("train_no", $journeys->train_no)->each(function($item) {
                $item->delete();
            });
            DetailBooking::where("train_no", $journeys->train_no)->each(function($item) {
                $item->delete();
            });
            DetailBooking::where("train_no", $journeys->train_no)->delete();
            return back()->with("success", "Berhasil menghapus perjalanan kereta");
        }
        return back()->with("error", "Gagal menghapus perjalanan kereta");
    }
}
