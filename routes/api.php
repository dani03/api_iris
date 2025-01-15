<?php

use App\Http\Controllers\API\V1\Articles\ArticleController;
use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\Auth\RegisterController;
use App\Http\Controllers\API\V1\Users\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', RegisterController::class);
// juste pour vérifier qu'on est bien connecté à l'api
Route::get('test', static function () {
    return response()->json("Vous êtes bien à l'API.", Response::HTTP_OK);
});
Route::post('login', LoginController::class);
Route::post('register', RegisterController::class);

//routes vers les articles sans authentification
// routes articles
Route::resource('articles', ArticleController::class);

Route::resource('users', UserController::class);

// routes commandes
