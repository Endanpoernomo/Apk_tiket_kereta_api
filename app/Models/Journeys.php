<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journeys extends Model
{
    use HasFactory;

    protected $table = "train_journeys";
    protected $primaryKey = "id";
    protected $guarded = [""];

    // relasiin sama model Kereta make kolom id_train yg ada di kolom train_journey, nanti nyambung sendiri dengan id_train yg sama dengan id kolom kereta
    public function kereta() {
        return $this->belongsTo(Kereta::class, "id_train")->withDefault();
    }
    // hubungin kereta api yg mau perjalanan sama tarif ongkos nya ke train_fare table lewat kolom train_no
    // karena kereta punya 3 kelas yaitu eksekutif, bisnis ama ekonomi, si train_fare alias tarif ya pasti ada 3 harga buat satuan kelas nya
    // jadinya pake hasMany yg dimana 1 kereta yg perjalanan ada 3 kelas untuk ongkos kereta di table fare
    // nanti nya bakal di sambungin lagi ke model Kereta biar kita tau ada berapa kursi yg tersedia buat kereta nya
    public function fare() {
        return $this->hasMany(Fare::class, "train_no", "train_no");
    }
    // untuk depart_station sama arrival_station kita jg perlu relasiin biar bisa dapet nama stasiunnya
    public function keberangkatan() {
        return $this->belongsTo(Stasiun::class, "depart_station")->withDefault();
    }

    public function kedatangan() {
        return $this->belongsTo(Stasiun::class, "arrival_station")->withDefault();
    }
}
