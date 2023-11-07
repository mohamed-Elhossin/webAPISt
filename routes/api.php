<?php

use App\Http\Controllers\AuthAPiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::post("register", [AuthAPiController::class, 'register']);
Route::post("login", [AuthAPiController::class, 'login']);

Route::middleware("auth:sanctum")->group(function () {


    Route::get("logout", [AuthAPiController::class, 'logout']);

    Route::prefix("student")->group(function () {
        Route::get("/", [StudentController::class, 'index']);
        Route::post("/", [StudentController::class, 'store'])->name("stuednt.store");
        Route::put("/{id}", [StudentController::class, 'update'])->name("stuednt.update");
        Route::get("/{id}", [StudentController::class, 'show'])->name("stuednt.show");
        Route::delete("/{id}", [StudentController::class, 'destroy'])->name("stuednt.destroy");
    });
});
