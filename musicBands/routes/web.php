<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BandController;


Route::get('/', function () {
    return view('home');
})->name('home');


//user routes
//Add User
Route::get('/add-users', [UserController::class, 'addUser'])->name('users.add');
//store user in db
Route::post('/store-user', [UserController::class, 'storeUser'])->name('users.store');


//bands routes
//list bands
Route::get('/bands', [BandController::class, 'index'])->name('bands.index');
//list albums of a band
Route::get('/bands/{band}/albums', [BandController::class, 'albums'])->name('bands.albums');

// edit band, just auth users
Route::get('/bands/{band}/edit', [BandController::class, 'edit'])->name('bands.edit')->middleware('auth');
Route::put('/bands/{band}', [BandController::class, 'update'])->name('bands.update')->middleware('auth');

// create and delete band, just admin users each are contollled in Controller
Route::get('/bands/create', [BandController::class, 'create'])->name('bands.create')->middleware('auth');
Route::post('/bands', [BandController::class, 'store'])->name('bands.store')->middleware('auth');
Route::delete('/bands/{band}', [BandController::class, 'destroy'])->name('bands.destroy')->middleware('auth');

//
