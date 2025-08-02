<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Journeys;
use App\Models\Stasiun;
use App\Models\kereta;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("route.index", [
            "routes" => Route::with(["journey", "kedatangan", "keberangkatan"])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah_route()
    {
        return view("route.tambah", [
            "trains" => Kereta::all(),
            "stations" => Stasiun::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function proses_tambah_route(Request $request)
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
            return redirect()->to("/routes")->with("success", "Berhasil menambahkan perjalanan kereta baru");
        }
        return redirect()->to("/route")->with("error", "Gagal menambahkan perjalanan kereta baru");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit(Route $route)
    {
        return view("route.edit", [
            "route" => $route,
            "stations" => Stasiun::all(),
            "trains" => Kereta::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Route $route)
    {
        $request->validate([
            "depart_station" => "required",
            "arrival_station" => "required",
            "depart_time" => "required",
            "arrival_time" => "required",
        ]);

        if ($route->update([
            "start_route" => $request->depart_station,
            "end_route" => $request->arrival_station,
            "depart_time" => $request->depart_time,
            "arrival_time" => $request->arrival_time,
        ])) {
            return $route->train_no;
            return Journeys::where("train_no", $route->train_no)->first();
            Journeys::where("train_no", $route->train_no)->first()->update($request->all());
            return to("/routes")->with("success", "Berhasil mengubah rute kereta");
        }
        return back()->with("error", "Gagal mengubah rute kereta");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy(Route $route)
    {
        if ($route->delete()) {
            Journeys::where("train_no", $route->train_no)->delete();
            return back()->with("success", "Berhasil menghapus route");
        }
        return back()->with("error", "Gagal menghapus route");
    }
}
