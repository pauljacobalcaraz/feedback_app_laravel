<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum', 'verified'],)->get('/auth', function () {
    return view('dashboard');
})->name('dashboard');


Route::resource('/dashboard', ProductController::class);

// Route::resource('/dashboard', CompanyController::class);

Route::resource('/companies', CompanyController::class);
// Route::resource('/company/restore', SoftDeletedCompanyController::class);
Route::get('/company/restore', [CompanyController::class, 'companyTrashed']);
Route::get('/company/restore/{id}', [CompanyController::class, 'companyRestoreTrashed']);

Route::resource('/products', ProductController::class);
Route::get('/product/restore', [ProductController::class, 'productTrashed']);
Route::get('/product/restore/{id}', [ProductController::class, 'productRestoreTrashed']);


Route::post('/filtered_feedback', [FeedbackController::class, 'filterFeedback']);
Route::resource('/feedbacks', FeedbackController::class);
Route::resource('/votes', VoteController::class);
Route::resource('/comments', CommentController::class);
