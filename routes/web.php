<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|// Route::get('/hello', function(){
//     return response('<h1>Hello world</h1>');
// });
*/

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing  

// ALL LISTINGS
Route::get('/', [ListingController::class, 'index']);

// CREATE LISTING
Route::get('listings/create', [ListingController::class, 'create'])->middleware('auth');

// STORE LISTING 
Route::post('/listings',  [ListingController::class, 'store'])->middleware('auth');

// EDIT FORM
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// UPDATE LISTING
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// DELETE LISTING
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// MANAGE LISTINGS
Route::get('listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// SINGLE LISTING 
Route::get('/listing/{listing}',  [ListingController::class, 'show']);

// REGISTER/LOGIN USER
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// CREATE A NEW USER
Route::post('/users', [UserController::class, 'store']);

// LOG USER OUT 
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// SHOW A LOGIN FORM 
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// LOGIN A USER
Route::post('/users/authenticate', [UserController::class, 'authenticate']);



