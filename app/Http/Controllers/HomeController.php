<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view("template.template");
    }
    public function dasboard() {
        return view("template.dasboard");
    }
    public function profile() {
        return view("template.profile");
    }
}
