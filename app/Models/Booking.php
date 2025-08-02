<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = "booking";
    protected $primaryKey = "id";
    protected $guarded = [""];

    public function detailBooking() {
        return $this->belongsTo(DetaiLBooking::class, "booking_code", "booking_code")->withDefault();
    }

    public function customers() {
        return $this->belongsTo(Customers::class, "id_customer")->withDefault();
    }
}
