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

//Admin
Route::middleware(['admin', 'auth'])->group(function () {
   //Users
   Route::get('/admin/index', [App\Http\Controllers\AdminController::class, 'index'])->name('admin_index'); 
   Route::post('/admin/index/verify', [App\Http\Controllers\AdminController::class, 'verify'])->name('admin_index_verify'); 
   Route::post('/admin/index/unverify', [App\Http\Controllers\AdminController::class, 'unverify'])->name('admin_index_unverify'); 
   Route::post('/admin/index/disable', [App\Http\Controllers\AdminController::class, 'disable'])->name('admin_index_disable'); 
   Route::post('/admin/index/activate', [App\Http\Controllers\AdminController::class, 'activate'])->name('admin_index_activate'); 
   Route::delete('/admin/index/delete', [App\Http\Controllers\AdminController::class, 'users_delete'])->name('admin_index_users_delete'); 
   Route::get('/admin/index/edit/{id}', [App\Http\Controllers\AdminController::class, 'edit'])->name('admin_index_edit'); 
   Route::put('/admin/index/edit', [App\Http\Controllers\AdminController::class, 'editUser'])->name('admin_index_edit_user'); 
   //Deposits
   Route::get('/admin/deposits', [App\Http\Controllers\AdminController::class, 'deposits'])->name('admin_deposits'); 
   Route::delete('/admin/deposits/delete', [App\Http\Controllers\AdminController::class, 'deposits_delete'])->name('admin_deposits_delete'); 
   Route::post('/admin/deposits/credit', [App\Http\Controllers\AdminController::class, 'credit'])->name('admin_deposits_credit'); 
   Route::post('/admin/deposits/uncredit', [App\Http\Controllers\AdminController::class, 'uncredit'])->name('admin_deposits_uncredit'); 
   //Soccer Tickets
   Route::get('/admin/soccer/tickets', [App\Http\Controllers\AdminSoccerController::class, 'soccerTicketIndex'])->name('admin_soccer_ticket_index'); 
   Route::delete('/admin/soccer/delete', [App\Http\Controllers\AdminSoccerController::class, 'soccerTicketDelete'])->name('admin_soccer_ticket_delete'); 
   Route::get('/admin/soccer/edit/{id}', [App\Http\Controllers\AdminSoccerController::class, 'soccerTicketEdit'])->name('admin_soccer_ticket_edit'); 
   Route::put('/admin/soccer/edit', [App\Http\Controllers\AdminSoccerController::class, 'editSoccerTicket'])->name('admin_soccer_ticket_edit_soccer_ticket'); 
   Route::get('/admin/soccer/add/create', [App\Http\Controllers\AdminSoccerController::class, 'soccerTicketCreate'])->name('admin_soccer_ticket_create'); 
   Route::post('/admin/soccer/add', [App\Http\Controllers\AdminSoccerController::class, 'soccerTicketAdd'])->name('admin_soccer_ticket_add'); 
   //Soccer Teams
   Route::get('/admin/soccer/teams', [App\Http\Controllers\AdminSoccerController::class, 'soccerTeamIndex'])->name('admin_soccer_team_index'); 
   Route::delete('/admin/soccer/teams/delete', [App\Http\Controllers\AdminSoccerController::class, 'soccerTeamDelete'])->name('admin_soccer_team_delete'); 
   Route::get('/admin/soccer/teams/edit/{id}', [App\Http\Controllers\AdminSoccerController::class, 'soccerTeamEdit'])->name('admin_soccer_team_edit'); 
   Route::put('/admin/soccer/teams/edit', [App\Http\Controllers\AdminSoccerController::class, 'editSoccerTeam'])->name('admin_soccer_team_edit_soccer_team'); 
   Route::get('/admin/soccer/teams/add/create', [App\Http\Controllers\AdminSoccerController::class, 'soccerTeamCreate'])->name('admin_soccer_team_create'); 
   Route::post('/admin/soccer/teams/add', [App\Http\Controllers\AdminSoccerController::class, 'soccerTeamAdd'])->name('admin_soccer_team_add'); 
   //BasketBall Tickets
   Route::get('/admin/basketball/tickets', [App\Http\Controllers\AdminBasketballController::class, 'basketballTicketIndex'])->name('admin_basketball_ticket_index'); 
   Route::delete('/admin/basketball/delete', [App\Http\Controllers\AdminBasketballController::class, 'basketballTicketDelete'])->name('admin_basketball_ticket_delete'); 
   Route::get('/admin/basketball/edit/{id}', [App\Http\Controllers\AdminBasketballController::class, 'basketballTicketEdit'])->name('admin_basketball_ticket_edit'); 
   Route::put('/admin/basketball/edit', [App\Http\Controllers\AdminBasketballController::class, 'editbasketballTicket'])->name('admin_basketball_ticket_edit_basketball_ticket'); 
   Route::get('/admin/basketball/add/create', [App\Http\Controllers\AdminBasketballController::class, 'basketballTicketCreate'])->name('admin_basketball_ticket_create'); 
   Route::post('/admin/basketball/add', [App\Http\Controllers\AdminBasketballController::class, 'basketballTicketAdd'])->name('admin_basketball_ticket_add'); 
   //BasketBall Teams
   Route::get('/admin/basketball/teams', [App\Http\Controllers\AdminBasketballController::class, 'basketballTeamIndex'])->name('admin_basketball_team_index'); 
   Route::delete('/admin/basketball/teams/delete', [App\Http\Controllers\AdminBasketballController::class, 'basketballTeamDelete'])->name('admin_basketball_team_delete'); 
   Route::get('/admin/basketball/teams/edit/{id}', [App\Http\Controllers\AdminBasketballController::class, 'basketballTeamEdit'])->name('admin_basketball_team_edit'); 
   Route::put('/admin/basketball/teams/edit', [App\Http\Controllers\AdminBasketballController::class, 'editbasketballTeam'])->name('admin_basketball_team_edit_basketball_team'); 
   Route::get('/admin/basketball/teams/add/create', [App\Http\Controllers\AdminBasketballController::class, 'basketballTeamCreate'])->name('admin_basketball_team_create'); 
   Route::post('/admin/basketball/teams/add', [App\Http\Controllers\AdminBasketballController::class, 'basketballTeamAdd'])->name('admin_basketball_team_add'); 
   //FootBall Tickets
   Route::get('/admin/football/tickets', [App\Http\Controllers\AdminFootBallController::class, 'footballTicketIndex'])->name('admin_football_ticket_index'); 
   Route::delete('/admin/football/delete', [App\Http\Controllers\AdminFootBallController::class, 'footballTicketDelete'])->name('admin_football_ticket_delete'); 
   Route::get('/admin/football/edit/{id}', [App\Http\Controllers\AdminFootBallController::class, 'footballTicketEdit'])->name('admin_football_ticket_edit'); 
   Route::put('/admin/football/edit', [App\Http\Controllers\AdminFootBallController::class, 'editfootballTicket'])->name('admin_football_ticket_edit_football_ticket'); 
   Route::get('/admin/football/add/create', [App\Http\Controllers\AdminFootBallController::class, 'footballTicketCreate'])->name('admin_football_ticket_create'); 
   Route::post('/admin/football/add', [App\Http\Controllers\AdminFootBallController::class, 'footballTicketAdd'])->name('admin_football_ticket_add'); 
   //FootBall Teams
   Route::get('/admin/football/teams', [App\Http\Controllers\AdminFootBallController::class, 'footballTeamIndex'])->name('admin_football_team_index'); 
   Route::delete('/admin/football/teams/delete', [App\Http\Controllers\AdminFootBallController::class, 'footballTeamDelete'])->name('admin_football_team_delete'); 
   Route::get('/admin/football/teams/edit/{id}', [App\Http\Controllers\AdminFootBallController::class, 'footballTeamEdit'])->name('admin_football_team_edit'); 
   Route::put('/admin/football/teams/edit', [App\Http\Controllers\AdminFootBallController::class, 'editfootballTeam'])->name('admin_football_team_edit_football_team'); 
   Route::get('/admin/football/teams/add/create', [App\Http\Controllers\AdminFootBallController::class, 'footballTeamCreate'])->name('admin_football_team_create'); 
   Route::post('/admin/football/teams/add', [App\Http\Controllers\AdminFootBallController::class, 'footballTeamAdd'])->name('admin_football_team_add'); 
   //Cricket Tickets
   Route::get('/admin/cricket/tickets', [App\Http\Controllers\AdminCricketController::class, 'cricketTicketIndex'])->name('admin_cricket_ticket_index'); 
   Route::delete('/admin/cricket/delete', [App\Http\Controllers\AdminCricketController::class, 'cricketTicketDelete'])->name('admin_cricket_ticket_delete'); 
   Route::get('/admin/cricket/edit/{id}', [App\Http\Controllers\AdminCricketController::class, 'cricketTicketEdit'])->name('admin_cricket_ticket_edit'); 
   Route::put('/admin/cricket/edit', [App\Http\Controllers\AdminCricketController::class, 'editcricketTicket'])->name('admin_cricket_ticket_edit_cricket_ticket'); 
   Route::get('/admin/cricket/add/create', [App\Http\Controllers\AdminCricketController::class, 'cricketTicketCreate'])->name('admin_cricket_ticket_create'); 
   Route::post('/admin/cricket/add', [App\Http\Controllers\AdminCricketController::class, 'cricketTicketAdd'])->name('admin_cricket_ticket_add'); 
   //Cricket Teams
   Route::get('/admin/cricket/teams', [App\Http\Controllers\AdminCricketController::class, 'cricketTeamIndex'])->name('admin_cricket_team_index'); 
   Route::delete('/admin/cricket/teams/delete', [App\Http\Controllers\AdminCricketController::class, 'cricketTeamDelete'])->name('admin_cricket_team_delete'); 
   Route::get('/admin/cricket/teams/edit/{id}', [App\Http\Controllers\AdminCricketController::class, 'cricketTeamEdit'])->name('admin_cricket_team_edit'); 
   Route::put('/admin/cricket/teams/edit', [App\Http\Controllers\AdminCricketController::class, 'editcricketTeam'])->name('admin_cricket_team_edit_cricket_team'); 
   Route::get('/admin/cricket/teams/add/create', [App\Http\Controllers\AdminCricketController::class, 'cricketTeamCreate'])->name('admin_cricket_team_create'); 
   Route::post('/admin/cricket/teams/add', [App\Http\Controllers\AdminCricketController::class, 'cricketTeamAdd'])->name('admin_cricket_team_add'); 
});

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