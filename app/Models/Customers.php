<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customers extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "customers";
    protected $primaryKey = "id";
    protected $guarded = [""];

     protected $fillable = [
        'name',
        'email',
        'password',
        'city',
        'country'
    ];

    protected $hidden = [
        'password',
    ];
}
