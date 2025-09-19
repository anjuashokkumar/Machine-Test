<?php

use Illuminate\Support\Facades\Route;
use ContactForm\Http\Controllers\ContactFormController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

Route::prefix('api')->group(function () {
    
    Route::post('/register', function (Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = JWTAuth::fromUser($user);
        return response()->json(['token' => $token]);
    });

    
    Route::middleware('auth:api')->group(function () {
        Route::post('/contact-form', [ContactFormController::class, 'store']);
        Route::get('/my-contact-forms', [ContactFormController::class, 'index']);
    });
});
