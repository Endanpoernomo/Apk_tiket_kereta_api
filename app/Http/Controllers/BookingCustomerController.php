<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\DetailBooking;
use App\Models\Fare;
use App\Models\Journeys;
use App\Models\Stasiun;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request("depart_station") && request("arrival_station") && request("depart_time")) {
            $journeys = Journeys::with(["kereta", "keberangkatan", "kedatangan"])->where("depart_station", request("depart_station"))->where("arrival_station", request("arrival_station"))->whereBetween("depart_time", [Carbon::parse(request("depart_time"))->startOfDay(), Carbon::parse(request("depart_time"))->endOfDay()])->get();
        } else {
            $journeys = Journeys::with(["kereta", "keberangkatan", "kedatangan"])->get();
        }

        return view("bookingCustomer.index", [
            "journeys" => $journeys,
            "stations" => Stasiun::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function booking_journey(Journeys $journeys)
    {
        return view("bookingCustomer.booking", [
            "kereta" => Journeys::with(["kereta", "fare", "keberangkatan", "kedatangan"])->find($journeys->id)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function proses_booking_journey(Request $request)
    {
        $booking = $request->validate([
            "train_no" => "required",
            "class" => "required",
            "seat" => "required",
            "booking_date" => "required"
        ]);
        
        $booking["booking_code"] = "BOOKING" . (Booking::latest()->first() ? Booking::latest()->first()->id + 1 : 1);
        $booking["id_customer"] = auth()->user()->id;
        $booking["payment_status"] = "belum_dibayar";
        
        $create = Booking::create($booking);
        if ($create) {
            $createDetail = DetailBooking::create([
                "train_no" => $booking["train_no"],
                "id_fare" => $booking["class"],
                "booking_code" => $create->booking_code
            ]);

            Passenger::create([
            "id_booking_det" => $createDetail->id,
            "seat" => $booking["seat"]
            ]);

            return redirect()->to("/customers/booking/detail")->with("success", "Berhasil booking kereta");
        }
        return redirect()->to("/customers/booking")->with("error", "Gagal booking kereta");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function detail_booking()
    {
        return view("bookingCustomer.detail", [
            "bookings" => Booking::with(["detailBooking", "detailBooking.kursi", "detailBooking.fare", "detailBooking.kereta", "detailBooking.kereta.keberangkatan", "detailBooking.kereta.kedatangan"])->where("id_customer", auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function proses_batal_booking_customer(Booking $booking)
    {
        if ($booking->delete()) {
            Passenger::where("id_booking_det", $booking->detailBooking->id)->delete();
            DetailBooking::where("booking_code", $booking->booking_code)->delete();
            return back()->with("success", "Berhasil membatalkan bookingan");
        }
        return back()->with("success", "Gagal membatalkan bookingan");
    }

    public function getSeat() {
        $kursi = DetailBooking::with(["kursi"])->where("train_no", request("data"))->where("id_fare", request("fare"))->get()->map(function($item, $key) {
            return $item->kursi->seat;
        })->all();

        $kelas = Fare::find(request("fare"))->class;
        if ($kelas == 'economy') {
            $total = Journeys::with(["kereta"])->where("train_no", request("data"))->first()->kereta->eco_seat_num;
        } else if ($kelas == 'business') {
            $total = Journeys::with(["kereta"])->where("train_no", request("data"))->first()->kereta->busines_seat_num;
        } else {
            $total = Journeys::with(["kereta"])->where("train_no", request("data"))->first()->kereta->exec_seat_num;
        }

        return response()->json([
            "kursi" => $kursi,
            "total" => $total
        ], 200);
    }

    public function cetak_tiket(Booking $booking) {
        // return $booking->detailBooking;
        return view("bookingCustomer.tiket", [
            "booking" => $booking
        ]);
    }
}
