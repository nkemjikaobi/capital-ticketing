<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
     public function activate(){

            $isActivated =  DB::table('users')
                       ->where('email', '=', request('email'))
                       ->update([
                           'isDisabled' => 0
                       ]);
            if($isActivated){
                return redirect('/admin/index')->with('success', 'User Activated');
            }
            else{
                return redirect('/admin/index')->with('error', 'An error occurred');
        }
    }

    public function credit(){

         $isCredited =  DB::table('deposits')
                       ->where('id', '=', request('id'))
                       ->update([
                           'isCredited' => 1
                       ]);
            if($isCredited){
                return redirect('/admin/deposits')->with('success', 'Deposit Credited');
            }
            else{
                return redirect('/admin/deposits')->with('error', 'An error occurred');
        }
    }

    public function deposits(){
        $deposits = Deposit::paginate(10);
        return view('admin.deposits.index', compact('deposits'));
    }

    public function deposits_delete(){
       $deposit =  DB::table('deposits')
                ->where('id', '=', request('id'))
                ->delete();
        
        if($deposit){
            return redirect('/admin/deposits')->with('success', 'Deposit Deleted');
        }
        else{
            return redirect('/admin/deposits')->with('error', 'An error occurred');
        }
    }

    public function disable(){

            $isDisabled =  DB::table('users')
                       ->where('email', '=', request('email'))
                       ->update([
                           'isDisabled' => 1
                       ]);
            if($isDisabled){
                return redirect('/admin/index')->with('success', 'User Disabled');
            }
            else{
                return redirect('/admin/index')->with('error', 'An error occurred');
        }
    }

    public function edit($id){
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function editUser(){
         $updatedUser =  DB::table('users')
                       ->where('email', '=', request('email'))
                       ->update([
                           'firstname' => request('firstname'),
                           'lastname' => request('lastname'),
                           'username' => request('username'),
                           'account_type' => request('account_type')
                       ]);

            if($updatedUser){
                return redirect('/admin/index')->with('success', 'User Updated');
            }
            else
            {
                return redirect('/admin/index')->with('error', 'An error occurred');
            }
    }

    public function index(){
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function makeAdmin(){
        $done =  DB::table('users')
                       ->where('email', '=', request('email'))
                       ->update([
                           'account_type' => 3
                       ]);
            if($done){
                return redirect('/admin/index')->with('success', 'User is now an admin');
            }
            else{
                return redirect('/admin/index')->with('error', 'An error occurred');
        }
    }

     public function uncredit(){

         $unCredited =  DB::table('deposits')
                       ->where('id', '=', request('id'))
                       ->update([
                           'isCredited' => 0
                       ]);
            if($unCredited){
                return redirect('/admin/deposits')->with('success', 'Deposit UnCredited');
            }
            else{
                return redirect('/admin/deposits')->with('error', 'An error occurred');
        }
    }

    public function unverify(){

            $isUnverified =  DB::table('users')
                       ->where('email', '=', request('email'))
                       ->update([
                           'isVerified' => 0
                       ]);
            if($isUnverified){
                return redirect('/admin/index')->with('success', 'User Unverified');
            }
            else{
            return redirect('/admin/index')->with('error', 'An error occurred');
        }
    }

    public function users_delete(){
       $user =  DB::table('users')
                ->where('email', '=', request('email'))
                ->delete();
        
        if($user){
            return redirect('/admin/index')->with('success', 'User Deleted');
        }
        else{
            return redirect('/admin/index')->with('error', 'An error occurred');
        }
    }

    public function verify(){

            $isVerified =  DB::table('users')
                       ->where('email', '=', request('email'))
                       ->update([
                           'isVerified' => 1
                       ]);
            if($isVerified){
                return redirect('/admin/index')->with('success', 'User Verified');
            }
            else{
            return redirect('/admin/index')->with('error', 'An error occurred');
        }
    }

      public function withdrawals(){

        $withdrawals = Withdrawal::paginate(10);

        return view ('admin.withdrawals.index',compact('withdrawals'));
    }

    public function withdrawals_success(){
       $done =  DB::table('withdrawals')
                       ->where('id', '=', request('id'))
                       ->update([
                           'status' => 1,
                       ]);
        
        if($done){
            return redirect('/admin/withdrawals')->with('success', 'Status Changed');
        }
        else{
            return redirect('/admin/withdrawals')->with('error', 'An error occurred');
        }
    }

    public function withdrawals_fail(){
        $done =  DB::table('withdrawals')
                       ->where('id', '=', request('id'))
                       ->update([
                           'status' => -1,
                       ]);
        
        if($done){
            return redirect('/admin/withdrawals')->with('success', 'Status Changed');
        }
        else{
            return redirect('/admin/withdrawals')->with('error', 'An error occurred');
        }
    }
 
}
