<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{
    public function getmessages(Request $request)
    {

        $user_id = $request->get('user_id');

        $data['withdraws'] = DB::table('withdraw')->join('user', 'withdraw.user_id', '=', 'user.id')
            ->select('withdraw.*', 'user.name')->where('withdraw.user_id', '=', $user_id)->get();
        // $data['messages'] = Message::all();
        return view('withdraw', $data);
    }
}
