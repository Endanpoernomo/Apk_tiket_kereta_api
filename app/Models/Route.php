<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $table = "train_route";
    protected $primaryKey = "id";
    protected $guarded = [""];

    public function journey() {
        return $this->belongsTo(Journeys::class, "train_no", "train_no")->withDefault();
    }

    public function keberangkatan() {
        return $this->belongsTo(Stasiun::class, "start_route")->withDefault();
    }

    public function kedatangan() {
        return $this->belongsTo(Stasiun::class, "end_route")->withDefault();
    }
}
