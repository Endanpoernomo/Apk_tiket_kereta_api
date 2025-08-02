<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kereta extends Model
{
    use HasFactory;

    protected $table = "trains";
    protected $primaryKey = "id";
    protected $guarded = [""];

    public function journeys() {
        return $this->hasMany(Journeys::class, "id_train");
    }
}
