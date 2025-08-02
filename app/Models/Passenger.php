<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $table = "passenger";
    protected $primaryKey = "id";
    protected $guarded = [""];

    public function detail_booking() {
        return $this->belongsTo(DetailBooking::class, "id_booking_det");
    }
}
