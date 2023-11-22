<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Software_Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Software_sale_Controller extends Controller
{
    public function getsoftwaresale(Request $request)
    {
        $name = $request->get('name');
        $data['software_sales'] = DB::table('software_sale')->join('software', 'software_sale.software_id', '=', 'software.id')->select('software_sale.*', 'software.name', 'software.price')->get();
        return view('software_sale', $data);

    }
    public function update_software_sale_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        try {
            $message = Software_Sale::find($id);
            $message->status = $status;
            if ($message->save()) {
                return response()->json(['success' => 'Message status change successfully.']);
            } else {
                return response()->json(['failed' => 'Message status change failed.']);
            }
        } catch (\Exception $e) {
            return response()->json(['failed'=>$e]);
        }
    }
}
