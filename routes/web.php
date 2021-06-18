<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//User Dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'view_profile'])->name('profile');
Route::put('/profile', [App\Http\Controllers\HomeController::class, 'update_profile'])->name('update_profile');
Route::get('/fund_wallet', [App\Http\Controllers\HomeController::class, 'fund_wallet'])->name('fund_wallet');
Route::post('/fund_wallet/create', [App\Http\Controllers\HomeController::class, 'fund_wallet_create'])->name('fund_wallet_create');
Route::get('/buy_tickets', [App\Http\Controllers\HomeController::class, 'buy_tickets'])->name('buy_tickets');
Route::get('/buy_tickets/football', [App\Http\Controllers\HomeController::class, 'buy_tickets_football'])->name('buy_tickets_football');
Route::get('/buy_tickets/cricket', [App\Http\Controllers\HomeController::class, 'buy_tickets_cricket'])->name('buy_tickets_cricket');
Route::post('/sell_tickets', [App\Http\Controllers\HomeController::class, 'sell_tickets'])->name('sell_tickets');
Route::get('/deposits', [App\Http\Controllers\HomeController::class, 'deposits'])->name('deposits');
Route::get('/view_tickets', [App\Http\Controllers\HomeController::class, 'view_tickets'])->name('view_tickets');
Route::get('/withdrawals', [App\Http\Controllers\HomeController::class, 'withdrawals'])->name('withdrawals');
Route::post('/webhook', [App\Http\Controllers\CoinBaseController::class, 'webhook'])->name('webhook');

//Soccer Routes
Route::get('/buy_tickets/soccer', [App\Http\Controllers\SoccerController::class, 'buy_tickets_soccer'])->name('buy_tickets_soccer');
Route::get('/buy_tickets/soccer/{id}/{fixture}', [App\Http\Controllers\SoccerController::class, 'buy_tickets_soccer_fixture'])->name('buy_tickets_soccer_fixture');
Route::post('/buy_tickets/soccer/pay', [App\Http\Controllers\SoccerController::class, 'buy_tickets_soccer_pay'])->name('buy_tickets_soccer_pay');
Route::post('/buy_tickets/soccer/pay/process', [App\Http\Controllers\SoccerController::class, 'buy_tickets_soccer_pay_process'])->name('buy_tickets_soccer_pay_process');
Route::get('/calculate_soccer_roi', [App\Http\Controllers\SoccerController::class, 'calculate_soccer_roi'])->name('calculate_soccer_roi');

//BasketBall Routes
Route::get('/buy_tickets/basketball', [App\Http\Controllers\BasketBallController::class, 'buy_tickets_basketball'])->name('buy_tickets_basketball');
Route::get('/buy_tickets/basketball/{id}/{fixture}', [App\Http\Controllers\BasketballController::class, 'buy_tickets_basketball_fixture'])->name('buy_tickets_basketball_fixture');
Route::post('/buy_tickets/basketball/pay', [App\Http\Controllers\BasketballController::class, 'buy_tickets_basketball_pay'])->name('buy_tickets_basketball_pay');
Route::post('/buy_tickets/basketball/pay/process', [App\Http\Controllers\BasketballController::class, 'buy_tickets_basketball_pay_process'])->name('buy_tickets_basketball_pay_process');
Route::get('/calculate_basketball_roi', [App\Http\Controllers\BasketballController::class, 'calculate_basketball_roi'])->name('calculate_basketball_roi');
