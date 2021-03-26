<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Models\Company;

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
    return view('welcome');
});

Route::get('/companies', function () {
    $companies = Company::all();
    return view('companies')->with('companies', $companies);
});

Route::get('/companies/{id}', function ($id) {
    $company = Company::find($id);
    return view('show-company')->with('company', $company);
});

//RECRUITER ROUTES
Route::get('/search/company', [DashboardController::class, 'searchCompany']);
Route::get('/dashboard/create-company', [DashboardController::class, 'createCompany']);
Route::post('/dashboard/create-company', [DashboardController::class, 'storeCompany']);
//RECRUITER ROUTES


Route::get('/dashboard/account', [DashboardController::class, 'editAccount']);
Route::get('/dashboard/account/user/{id}', [DashboardController::class, 'editUser']);
Route::delete('/dashboard/account/user/{id}', [DashboardController::class, 'deleteUser']);
Route::patch('/dashboard/account/update-password/{id}', [DashboardController::class, 'updatePassword']);
Route::patch('/dashboard/account/update-details/{id}', [DashboardController::class, 'updateDetails']);

Route::get('/dashboard/select-account', [DashboardController::class, 'SelectAccount']);
Route::post('/dashboard/assign-role', [DashboardController::class, 'assignRole']);

Route::resource('/dashboard', DashboardController::class);

require __DIR__.'/auth.php';
