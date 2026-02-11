<?php

use App\Http\Controllers\DefenceController;
use App\Http\Controllers\AttackController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// defence


Route::get('/defence', [DefenceController::class, 'index'])
    ->name('defence.index');

Route::get('/defence/create', [DefenceController::class, 'create'])
    ->name('defence.create');

Route::get('/defence/show', [DefenceController::class, 'show'])
    ->name('defence.show');

Route::get('/defence/edit', [DefenceController::class, 'edit'])
    ->name('defence.edit');

// attack

Route::get('/attack', [AttackController::class, 'index'])
    ->name('attack.index');

Route::get('/attack/create', [AttackController::class, 'create'])
    ->name('attack.create');

Route::get('/attack/show', [AttackController::class, 'show'])
    ->name('attack.show');

Route::get('/attack/edit', [AttackController::class, 'edit'])
    ->name('attack.edit');