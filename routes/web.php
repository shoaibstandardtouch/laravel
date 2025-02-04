<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\AvatarController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use OpenAI\Laravel\Facades\OpenAI;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;



Route::get('/', function () {
    // $users = User::all();
    // dd($users);
    return view('welcome');

    // $user = User::where('email', 'shoaib@standardtouch.com')->first(); // Replace with the correct email or user

    // // Check if the user exists
    // if ($user) {
    //     // Check if the provided password matches the hashed password in the database
    //     if (Hash::check('12345678', $user->password)) {
    //         dd('Password is correct!');
    //     } else {
    //         dd('Password is incorrect!');
    //     }
    // } else {
    //     dd('User not found!');
    // }
    
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');  
});

require __DIR__.'/auth.php';
 
Route::post('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('login.github');
 
Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
    $user = User::firstOrCreate(['email'=>$user->email],[
        'name' => $user->name,
        'password' => 'password',
    ]);
    Auth::login($user);
    return redirect('/dashboard');
 
    // $user->token
});

Route::middleware('auth')->group(function(){
    Route::resource('/ticket', TicketController::class);
});


