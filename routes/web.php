<?php

use App\Http\Controllers\PhoneNumberController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PhoneNumberController::class, 'index'])->name('phones.index');
