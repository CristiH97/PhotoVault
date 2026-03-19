<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Public routes (no authentication required)
Route::post("/register", [UserController::class,"register"]);
Route::post("/login", [UserController::class,"login"]);




// Protected routes (require authentication via Sanctum)
Route::group(['middleware' => ['auth:sanctum']], function (){

    // User actions
    Route::post("/logout", [UserController::class,"logout"]);

    // Album management
    Route::get("/albums", [AlbumController::class,"getUserAlbums"]);
    Route::post("/albums", [AlbumController::class,"store"]);
    Route::put("/albums/{album}", [AlbumController::class,"update"]);
    Route::delete('/albums/{album}', [AlbumController::class, 'destroy']);

    // Photo management within albums
    Route::get('/albums/{album}/photos', [PhotoController::class, 'getAllPhotosFromAlbum']);
    Route::post('/albums/{album}/photos', [PhotoController::class, 'store']);
    Route::delete('/albums/{album}/photos', [PhotoController::class, 'destroy']);

     // Health check / debug
    Route::get('/check', function (Request $request) {
        return response()->json(['status' => 'ok']);
    });

});
