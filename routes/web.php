<?php

use App\Mail\ChargeCreatedMail;
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

Auth::routes();

//Home Page
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'welcome'])->name('welcome');

// Route::get('/email', function(){
//     return new ChargeCreatedMail(500);
// });

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
Route::get('/transfer_funds', [App\Http\Controllers\HomeController::class, 'transfer_funds'])->name('transfer_funds')->middleware('seller');
Route::post('/transfer_funds/transfer', [App\Http\Controllers\HomeController::class, 'transfer_funds_transfer'])->name('transfer_funds_transfer')->middleware('seller');
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


//Football Routes
Route::get('/buy_tickets/football', [App\Http\Controllers\FootBallController::class, 'buy_tickets_football'])->name('buy_tickets_football');
Route::get('/buy_tickets/football/{id}/{fixture}', [App\Http\Controllers\FootballController::class, 'buy_tickets_football_fixture'])->name('buy_tickets_football_fixture');
Route::post('/buy_tickets/football/pay', [App\Http\Controllers\FootballController::class, 'buy_tickets_football_pay'])->name('buy_tickets_football_pay');
Route::post('/buy_tickets/football/pay/process', [App\Http\Controllers\FootballController::class, 'buy_tickets_football_pay_process'])->name('buy_tickets_football_pay_process');
Route::get('/calculate_football_roi', [App\Http\Controllers\FootballController::class, 'calculate_football_roi'])->name('calculate_football_roi');

//Cricket Routes
Route::get('/buy_tickets/cricket', [App\Http\Controllers\CricketController::class, 'buy_tickets_cricket'])->name('buy_tickets_cricket');
Route::get('/buy_tickets/cricket/{id}/{fixture}', [App\Http\Controllers\CricketController::class, 'buy_tickets_cricket_fixture'])->name('buy_tickets_cricket_fixture');
Route::post('/buy_tickets/cricket/pay', [App\Http\Controllers\CricketController::class, 'buy_tickets_cricket_pay'])->name('buy_tickets_cricket_pay');
Route::post('/buy_tickets/cricket/pay/process', [App\Http\Controllers\CricketController::class, 'buy_tickets_cricket_pay_process'])->name('buy_tickets_cricket_pay_process');
Route::get('/calculate_cricket_roi', [App\Http\Controllers\CricketController::class, 'calculate_cricket_roi'])->name('calculate_cricket_roi');