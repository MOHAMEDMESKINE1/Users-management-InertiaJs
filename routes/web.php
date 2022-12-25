<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
// Route::inertia('about','About')->name('users.about');
// Route::get('create',function(){
//     return Inertia::render('Users/Create');
// // })->name('users.add');


 Route::group(['middleware'=>"auth"],function(){
    Route::inertia('about','About')->name('users.about');
    Route::inertia('create','Users/Create')->name('users.create');

 });

Route::controller(UserController::class)
->name('users.')
->middleware('auth')
->prefix('users')
->group(function(){
    

    Route::get('','index')->name('index');
    Route::get('edit/{id}','edit')->name('edit');
    Route::post('store','store')->name('store');
    Route::put('update/{id}','update')->name('update');
    Route::delete('delete/{id}','destroy')->name('destroy');
    
});


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::controller(ProfileController::class)
->middleware('auth')
->prefix('/profile')
->name('profile.')
->group(function () {
    Route::get('','edit')->name('edit');
    Route::patch('','update')->name('update');
    Route::delete('','destroy')->name('destroy');
});

require __DIR__.'/auth.php';
