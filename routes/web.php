<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeretaController;
use App\Http\Controllers\StasiunController;
use App\Http\Controllers\JourneysController;
use App\Http\Controllers\FareController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingCustomerController;
use App\Http\Controllers\RouteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get("/login", [AutentikasiController::class, "login"])->name("login")->middleware("guest");
Route::post("/proses_login", [AutentikasiController::class, "proses_login"])->middleware("guest");

Route::get("/customers/login", [AutentikasiController::class, "loginCustomer"])->name("loginCustomer")->middleware("guest");
Route::post("/proses_login_customer", [AutentikasiController::class, "proses_login_customer"])->middleware("guest");

Route::get("/customers/register", [AutentikasiController::class, "registerCustomer"])->name("registerCustomer")->middleware("guest");
Route::post("/proses_register_customer", [AutentikasiController::class, "proses_register_customer"])->middleware("guest");


Route::prefix("/")->middleware("auth:user,customer")->group(function() {
    Route::get("/", [HomeController::class, "index"]);
    Route::get("/dasboard", [HomeController::class, "dasboard"]);
    Route::get("/profile", [HomeController::class, "profile"]);


    Route::get("/customers", [CustomersController::class, "index"]);
    
    //booking customer
    Route::get("/customers/booking", [BookingCustomerController::class, "index"]);
    Route::get("/customers/booking/detail", [BookingCustomerController::class, "detail_booking"]);
    Route::post("/customers/booking/proses_tambah_booking", [BookingCustomerController::class, "proses_booking_journey"]);
    Route::get("/customers/booking/{journeys:id}", [BookingCustomerController::class, "booking_journey"]);
    Route::delete("/customers/booking/proses_batal_booking_customer/{booking:id}", [BookingCustomerController::class, "proses_batal_booking_customer"]);
    Route::get("/customers/booking/tiket/{booking:id}", [BookingCustomerController::class, "cetak_tiket"]);

    Route::get("/getSeat", [BookingCustomerController::class, "getSeat"]);

    Route::get("/customers/tambah_customers", [CustomersController::class, "tambah_customers"]);
    Route::post("/customers/proses_tambah_customers", [CustomersController::class, "proses_tambah_customers"]);
    Route::get("/customers/{customers:id}", [CustomersController::class, "edit_customers"]);
    Route::put("/customers/{customers:id}", [CustomersController::class, "proses_edit_customers"]);
    Route::delete("/customers/{customers:id}", [CustomersController::class, "proses_hapus_customers"]);

    Route::get("/booking", [BookingController::class, "index"]);
    Route::get("/booking/detail/{journeys:id}", [BookingController::class, "detail_booking"]);
    Route::get("/booking/{detail_booking:id}", [BookingController::class, "edit_booking"]);
    Route::put("/booking/{detail_booking:id}", [BookingController::class, "proses_edit_booking"]);
    Route::delete("/booking/{detail_booking:id}", [BookingController::class, "batal_booking"]);
    Route::get("/booking/laporan/{journeys:id}", [BookingController::class, "laporan"]);



    Route::get("/kereta", [KeretaController::class, "index"]);
    Route::get("/kereta/tambah_kereta", [KeretaController::class, "tambah_kereta"]);
    Route::post("/kereta/proses_tambah_kereta", [KeretaController::class, "proses_tambah_kereta"]);
    //{kereta:id} fungsinya route model binding. nanti id kirim ke url. di sini di tangkep trus lgsng di cariin sama model kereta yg dimana id nya sama dengan yg di berikan di url
    Route::get("/kereta/{kereta:id}", [KeretaController::class, "edit_kereta"]);
    Route::put("/kereta/{kereta:id}", [KeretaController::class, "proses_edit_kereta"]);
    Route::delete("/kereta/{kereta:id}", [KeretaController::class, "proses_hapus_kereta"]);

    Route::get("/stasiun", [StasiunController::class, "index"]);
    Route::get("/stasiun/tambah_stasiun", [StasiunController::class, "tambah_stasiun"]);
    Route::post("/stasiun/proses_tambah_stasiun", [StasiunController::class, "proses_tambah_stasiun"]);
    Route::get("/stasiun/{stasiun:id}", [StasiunController::class, "edit_stasiun"]);
    Route::put("/stasiun/{stasiun:id}", [StasiunController::class, "proses_edit_stasiun"]);
    Route::delete("/stasiun/{stasiun:id}", [StasiunController::class, "proses_hapus_stasiun"]);

    Route::get("/journeys", [JourneysController::class, "index"]);
    Route::get("/journeys/tambah_journeys", [JourneysController::class, "tambah_journeys"]);
    Route::post("/journeys/proses_tambah_journeys", [JourneysController::class, "proses_tambah_journeys"]);
    Route::get("/journeys/{journeys:id}", [JourneysController::class, "edit_journeys"]);
    Route::put("/journeys/{journeys:id}", [JourneysController::class, "proses_edit_journeys"]);
    Route::delete("/journeys/{journeys:id}", [JourneysController::class, "proses_hapus_journeys"]);

    Route::get("/fare", [FareController::class, "index"]);
    Route::get("/fare/tambah_fare/{code}", [FareController::class, "tambah_fare"]);
    Route::post("/fare/proses_tambah_fare", [FareController::class, "proses_tambah_fare"]);
    Route::get("/fare/detail/{code}", [FareController::class, "show"]);
    Route::get("/fare/{fare:id}", [FareController::class, "edit"]);
    Route::put("/fare/proses_edit_fare/{fare:id}", [FareController::class, "proses_edit_fare"]);
    Route::delete("/fare/{fare:id}", [FareController::class, "proses_hapus_fare"]);

    Route::get("/routes", [RouteController::class, "index"]);
    Route::get("/routes/tambah", [RouteController::class, "tambah_route"]);
    Route::post("/routes/proses_tambah_route", [RouteController::class, "proses_tambah_route"]);
    Route::get("/routes/{route:id}", [RouteController::class, "edit"]);
    Route::put("/routes/{route:id}", [RouteController::class, "update"]);
    Route::delete("/routes/{route:id}", [RouteController::class, "destroy"]);
    
    Route::get("/users", [UserController::class, "index"]);
    Route::get("/users/tambah_users", [UserController::class, "tambah_users"]);
    Route::post("/users/proses_tambah_users", [UserController::class, "proses_tambah_users"]);
    Route::get("/users/{user:id}", [UserController::class, "edit_users"]);
    Route::put("/users/{user:id}", [UserController::class, "proses_edit_users"]);
    Route::delete("/users/{user:id}", [UserController::class, "proses_hapus_users"]);

    Route::post("/logout", [AutentikasiController::class, "proses_logout"]);
});