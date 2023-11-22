<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;    

class WalletController extends Controller
{
    public function getwallet(Request $request){
$data['wallets']=DB::table('wallet')->join('user','wallet.user_id','=','user.id')->select('wallet.*','user.name')->get();
return view('wallet', $data);
    }
}
