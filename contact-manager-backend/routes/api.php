<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;

Route::group(["middleware" => "auth:api"], function(){
    $user = Auth::user(); 


    Route::group(["prefix" => "user"], function(){
        Route::post("logout", [AuthController::class, "logout"]);
        Route::post("refresh", [AuthController::class, "refresh"]);
        Route::post('/contacts/{id}', [ContactController::class, 'storeContact']);
        Route::get('/contacts/{id}', [ContactController::class, 'getContacts']);
        Route::put('/contacts/{id}', [ContactController::class, 'updateContact']);
        Route::delete('/contacts/{id}', [ContactController::class, 'destroyContact']);

    });

});


Route::group(["prefix" => "guest"], function(){
    Route::get("unauthorized", [AuthController::class, "unauthorized"])->name("unauthorized");
    Route::post("login", [AuthController::class, "login"]);
    Route::post("register", [AuthController::class, "register"]);
});


