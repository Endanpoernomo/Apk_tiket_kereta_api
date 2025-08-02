<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fare extends Model
{
    use HasFactory;

    protected $table = "train_fare";
    protected $primaryKey = "id";
    protected $guarded = [""];
    
    // hubungin tarif kursi ke kereta yg mau jalan lewat train_no. nanti di model Journeys bakal di hubungin lagi ke table Kereta
    public function kereta() {
        return $this->belongsTo(Journeys::class, "train_no", "train_no")->withDefault();
    }

    public function detailbooking() {
        return $this->hasMany(DetailBooking::class, "id_fare")->withDefault();
    }
}
