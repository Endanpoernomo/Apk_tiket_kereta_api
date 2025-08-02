<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBooking extends Model
{
    use HasFactory;

    protected $table = "det_booking";
    protected $primaryKey = "id";
    protected $guarded = [""];

    public function booking() {
        return $this->belongsTo(Booking::class, "booking_code", "booking_code")->withDefault();
    }

    public function fare() {
        return $this->belongsTo(Fare::class, "id_fare")->withDefault();
    }

    public function kereta() {
        return $this->belongsTo(Journeys::class, "train_no", "train_no")->withDefault();
    }

    public function kursi() {
        return $this->belongsTo(Passenger::class, "id", "id_booking_det")->withDefault();
    }
}
