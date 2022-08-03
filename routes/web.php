<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', [UserController::class, 'index']);

// Add New Task
Route::post('/user', [UserController::class, 'add_user']);

Route::delete('/delete/{id}', [UserController::class, 'delete_user']);

Route::get('cache-data', function () {
      
    $user = \Cache::remember('user', 60, function() {
            return \App\Models\User::first();
        });
       
});
