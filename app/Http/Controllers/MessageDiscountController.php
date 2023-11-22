<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MessageDiscount;
use Illuminate\Http\Request;

class MessageDiscountController extends Controller
{
    public function messagediscountinsertApi(Request $request)
    {
        $newRecord = new  MessageDiscount;
        $newRecord->message_id = $request->get('message_id');
        $newRecord->voucher_code = $request->get('voucher_code');
        $newRecord->voucher_discount_percentage = $request->get('voucher_discount_percentage');
        $newRecord->expiry = $request->get('expiry');
        $newRecord->is_private = $request->get('is_private');
        try {
            if ( $newRecord->save()) {
                $id = $newRecord->getkey();
                $result['status'] = 'Ok';
                $result['status_code'] = '200';
                $result['message'] = ' Message Discount Inserted Successfully!';
                $result['inserted_id'] = $id;
            }
            else {
                $id = $newRecord->getkey();
                $result['status'] = 'Failed';
                $result['status_code'] = '300';
                $result['message'] = ' Message Discount Insertion Unsuccessfull!';
                $result['inserted_id'] = $id;
            }
        } catch (\Exception $e) {
                 return "Message Discount Insertion Failed";
        }
        $response=array();
        array_push($response,$result);
        return json_encode($response);
    
    }

    public function messagediscountupdateApi(Request $request)
    {
        $id = $request->get('id');
        $message_id = $request->get('message_id');
        $voucher_code = $request->get('voucher_code');
        $voucher_discount_percentage = $request->get('voucher_discount_percentage');
        $expiry = $request->get('expiry');
        $is_private = $request->get('is_private');

        $updateModel = MessageDiscount::find($id);
        $updateModel->message_id = $message_id;
        $updateModel->voucher_code = $voucher_code;
        $updateModel->voucher_discount_percentage = $voucher_discount_percentage;
        $updateModel->expiry = $expiry;
        $updateModel->is_private = $is_private;

        try {
            $updateModel->save();
            $result['status'] = 'Ok';
            $result['status_code'] = '200';
            $result['message'] = 'Message Discount Updated Successfully!';
            $result['inserted_id'] = $id;       
         } catch (\Exception $e) {
                $result['status'] = 'Failed';
                $result['status_code'] = '300';
                $result['message'] = ' Message Discount Updation Unsuccessfull!';
                $result['inserted_id'] = $id;
        }
        $response=array();
        array_push($response,$result);
        return json_encode($response);
    }
     
    public function messagediscountdeleteApi(Request $request){
        $id=$request->get('id');
        try {
            MessageDiscount::destroy($id);
            $result['status'] = 'Ok';
            $result['status_code'] = '200';
            $result['message'] = 'Message Discount Deleted Successfully!';
            $result['inserted_id'] = $id; 
        } catch (\Exception $e) {
            $result['status'] = 'Failed';
            $result['status_code'] = '300';
            $result['message'] = ' Message Discount Deletion Unsuccessfull!';
            $result['inserted_id'] = $id;
        }
        $response = array();
        array_push($response,$result);
        return json_encode($response);
    }

    public function messagediscount_get_by_id(Request $request){
        $id=$request->get('$id');
        $data=MessageDiscount::find($id);
        return json_encode($data);

    }
}
