<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManageGameController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);

Route::get("/register", [RegisterController::class, "index"])->middleware("guest");
Route::post("/register", [RegisterController::class, "store"]);

Route::get("/login", [LoginController::class, "index"])->middleware("guest");
Route::post("/login", [LoginController::class, "authenticate"]);
Route::post("/logout", [LoginController::class, "logout"]);

Route::get('/search', [GameController::class, 'search']);
Route::get('/add-game', [GameController::class, 'index']);
Route::post('/add-game', [GameController::class, 'store']);
Route::get('/game/{game:slug}', [GameController::class, 'detail']);
Route::post('/game/{game:slug}', [GameController::class, 'checkAge']);

Route::get('/game/add-to-cart/{game:id}', [GameController::class, 'addToCart']);

Route::get('/history', [TransactionController::class, 'index']);
Route::get('/shopping-cart', [GameController::class, 'detailShoppingCart']);
Route::get('/shopping-cart/{game:id}', [GameController::class, 'deleteCart']);
Route::get('/transaction', [TransactionController::class, 'idxTransaction']);
Route::post('/transaction', [TransactionController::class, 'storeTransaction']);

Route::get('/transaction/{transaction:uuid_transaction}', [TransactionController::class, 'receiptTransaction']);

Route::get('/user/profile', [UserController::class, 'index']);
Route::post('/user/profile', [UserController::class, "changeProfile"]);


Route::get('/manage-game', [ManageGameController::class, 'index']);
Route::delete('/game/{game:slug}/delete', [ManageGameController::class, 'destroy']);
Route::get('/game/{game:slug}/update', [ManageGameController::class, 'edit']);
Route::post('/game/{game:slug}/update', [ManageGameController::class, 'update']);
