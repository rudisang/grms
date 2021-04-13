<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobPostController;
use App\Models\Company;
use App\Models\JobPost;

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
    $jobs = JobPost::orderBy('created_at', 'desc')->paginate(6);
    return view('welcome')->with('jobs', $jobs);
});

Route::get('/companies', function () {
    $companies = Company::all();
    return view('companies')->with('companies', $companies);
});

Route::get('/companies/{id}', function ($id) {
    $company = Company::find($id);
    return view('show-company')->with('company', $company);
});

Route::get('/apply/{id}', [DashboardController::class, 'applyForm']);
Route::get('/applications/{id}', [DashboardController::class, 'viewApplications']);
Route::post('/apply/{id}', [DashboardController::class, 'apply']);

Route::get('/profile/create', [DashboardController::class, 'createProfile']);
Route::post('/profile/create', [DashboardController::class, 'storeProfile']);
Route::post('/attachment/create', [DashboardController::class, 'storeAttachment']);
Route::patch('/attachment/edit/{id}', [DashboardController::class, 'updateAttachment']);

//RECRUITER ROUTES
Route::get('/search/company', [DashboardController::class, 'searchCompany']);
Route::get('/dashboard/create-company', [DashboardController::class, 'createCompany']);
Route::post('/dashboard/create-company', [DashboardController::class, 'storeCompany']);
Route::get('/dashboard/edit-company/{id}', [DashboardController::class, 'editCompany']);
Route::patch('/dashboard/edit-company/{id}', [DashboardController::class, 'updateCompany']);
//RECRUITER ROUTES

//JOB POST ROUTES
Route::get('/jobs', [JobPostController::class, 'allJobs']);
Route::get('/jobs/{id}', [JobPostController::class, 'showJob']);
Route::get('/dashboard/job-post/create', [DashboardController::class, 'createJobPost']);
Route::post('/dashboard/job-post/create', [DashboardController::class, 'storeJobPost']);
Route::patch('/dashboard/job-post/edit/{id}', [DashboardController::class, 'editJobPost']);
Route::post('/jobs/category/add', [DashboardController::class, 'storeJobCategory']);
Route::patch('/jobs/category/edit/{id}', [DashboardController::class, 'editJobCategory']);
//JOB POST ROUTES

Route::get('/dashboard/account', [DashboardController::class, 'editAccount']);
Route::get('/dashboard/account/user/{id}', [DashboardController::class, 'editUser']);
Route::delete('/dashboard/account/user/{id}', [DashboardController::class, 'deleteUser']);
Route::patch('/dashboard/account/update-password/{id}', [DashboardController::class, 'updatePassword']);
Route::patch('/dashboard/account/update-details/{id}', [DashboardController::class, 'updateDetails']);

Route::get('/dashboard/select-account', [DashboardController::class, 'SelectAccount']);
Route::post('/dashboard/assign-role', [DashboardController::class, 'assignRole']);

Route::resource('/dashboard', DashboardController::class);

require __DIR__.'/auth.php';
