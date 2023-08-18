<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersManagmentController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\doctorSchedulesController;

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

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/addcustomer', [UsersManagmentController::class, 'index'])->name('addcustomer');


Route::get('/', function () {
    return view('theme');
})->name('theme');


Route::get('/doctor-schedule', [doctorSchedulesController::class, 'schedules'])->name('schedules');

Route::post('/update-schedule', [doctorSchedulesController::class, 'updateschedule'])->name('update-schedule');

Route::post('/add-customer', [App\Http\Controllers\UsersManagmentController::class, 'addCustomer'])->name('add-customer');
Route::get('/display-customers', [UsersManagmentController::class, 'displayCustomers'])->name('customerslist');


Route::post('/update-user', [UsersManagmentController::class, 'updateUser'])->name('update-user');

Route::get('/delete-user/{id}', [UsersManagmentController::class, 'deleteUser'])->name('delete-user');

Route::get('/filter-customers/{role?}', [UsersManagmentController::class, 'filterCustomers'])->name('filter-customers');

Route::get('/test-email', [AppointmentController::class,'testEmail']);


//appointment Routes : 
Route::get('/test', [AppointmentController::class, 'appointments2'])->name('doctor-appointments');

Route::get('/doctor-appointments', [AppointmentController::class, 'appointments'])->name('doctor-appointments');

Route::get('/confirm-appointment/{id}', [AppointmentController::class, 'confirm'])->name('confirm-appointment');


Route::get('/reject-appointment/{id}', [AppointmentController::class, 'reject'])->name('reject-appointment');





Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register2', [AuthController::class, 'register'])->name('register2');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

