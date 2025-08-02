<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\DetailBooking;
use App\Models\Kereta;
use App\Models\Journeys;
use App\Models\Passenger;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("booking.index", [
            "journeys" => Journeys::with(["kereta", "keberangkatan", "kedatangan"])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function detail_booking(Journeys $journeys)
    {
        return view("booking.detail", [
            "bookings" => DetailBooking::with(["booking.customers"])->where("train_no", $journeys->train_no)->get(),
            "journey" => $journeys
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit_booking(DetailBooking $detailBooking)
    {
        return view("booking.edit", [
            "booking" => $detailBooking,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function proses_edit_booking(Request $request, DetailBooking $detailBooking)
    {
        $request->validate([
            "payment_status" => "required",
        ]);
        
        if ($detailBooking->booking->update($request->all())) {
            return redirect()->to("booking/")->with("success", "Berhasil Merubah Status Pembayaran");
        }
        return redirect()->to("booking/$detailBooking->id")->with("error", "Gagal Merubah Status Pembayaran");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function batal_booking(DetailBooking $detailBooking)
    {
        if (Booking::where("booking_code", $detailBooking->booking_code)->delete()) {
            $detailBooking->delete();
            Passenger::where("id_booking_det", $detailBooking->id)->delete();
            return back()->with("success", "Berhasil membatalkan booking");
        }
        return back()->with("gagal", "Gagal membatalkan booking");
    }
    public function laporan(Journeys $journeys)
    {
        return view("booking.laporan",[
            "bookings" => DetailBooking::with(["booking.customers"])->where("train_no", $journeys->train_no)->get(),
            "journey" => $journeys
        ]);
    }
}
