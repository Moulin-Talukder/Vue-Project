<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//PUBLIC 

//register
Route::post('/register', [AuthController::class, 'register']);

//login
Route::post('/login', [AuthController::class, 'login']);

//get products
Route::get('/getProducts', [ProductController::class, 'getProducts']);

//search
Route::get('/products/search/{name}', [ProductController::class, 'search']);


//PROTECTED ROUTES

Route::middleware('auth:sanctum')->get('/user', function () {

    //add products
Route::post('/addProducts', [ProductController::class, 'store']);


//delete product
Route::delete('/deleteProducts/{id}', [ProductController::class, 'delete']);

//logout
Route::post('/logout', [AuthController::class, 'logout']);
    
});
