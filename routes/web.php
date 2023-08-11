<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersManagmentController;

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

Route::get('/', function () {
    return view('tabs');
});
Route::get('/addcustomer', function () {
    return view('add-customer');
})->name('addcustomer');



Route::get('/', function () {
    return view('theme');
})->name('theme');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/add-customer', [App\Http\Controllers\UsersManagmentController::class, 'addCustomer'])->name('add-customer');
Route::get('/display-customers/{role?}', [UsersManagmentController::class, 'displayCustomers'])->name('customerslist');

Route::post('/update-user', [UsersManagmentController::class, 'updateUser'])->name('update-user');

Route::get('/delete-user/{id}', [UsersManagmentController::class, 'deleteUser'])->name('delete-user');

Route::get('/filter-customers/{role?}', [UsersManagmentController::class, 'filterCustomers'])->name('filter-customers');
