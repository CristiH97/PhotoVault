<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Public routes

Route::post("/register", [UserController::class,"register"]);
Route::post("/login", [UserController::class,"login"]);




//Protected routes

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::post("/logout", [UserController::class,"logout"]);

    Route::get("/albums", [AlbumController::class,"getUserAlbums"]);
    Route::post("/albums", [AlbumController::class,"store"]);
    Route::put("/albums/{album}", [AlbumController::class,"update"]);
    Route::delete('/albums/{album}', [AlbumController::class, 'destroy']);
    Route::get('/albums/{album}/photos', [PhotoController::class, 'getAllPhotosFromAlbum']);
    Route::post('/albums/{album}/photos', [PhotoController::class, 'store']);

    Route::get("/test", function (Request $request) {
    return "testtt";
});
});
