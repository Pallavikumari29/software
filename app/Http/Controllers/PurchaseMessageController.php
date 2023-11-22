<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\purchasemessage;
use Illuminate\Http\Request;

class PurchaseMessageController extends Controller
{
    public function purchasemessageinsertApi(Request $request)
    {
        $newRecord = new purchasemessage;
        $newRecord->user_id = $request->get('user_id');
        $newRecord->message_id = $request->get('message_id');
        $newRecord->amount = $request->get('amount');
        $newRecord->status = $request->get('status');
        try {
            if ($newRecord->save()) {
                $id = $newRecord->getkey();
                $result['status'] = 'Ok';
                $result['status_code'] = '200';
                $result['message'] = 'Purchase Message Inserted Successfully!';
                $result['inserted_id'] = $id;
            } else {
                $id = $newRecord->getkey();
                $result['status'] = 'Failed';
                $result['status_code'] = '300';
                $result['message'] = 'Purchase Message Insertion Unsuccessfull!';
                $result['inserted_id'] = $id;
            }
        } catch (\Exception $e) {
            return "Purchase Message Insertion Failed";
        }
        $response=array();
        array_push($response, $result);
        return json_encode ($response);
    }

    public function purchasemessageupdateApi(Request $request)
    {
        $id = $request->get('id');
        $user_id = $request->get('user_id');
        $message_id = $request->get('message_id');
        $amount = $request->get('amount');
        $status = $request->get('status');

        $updateModel = purchasemessage::find($id);
        $updateModel->user_id = $user_id;
        $updateModel->message_id = $message_id;
        $updateModel->amount = $amount;
        $updateModel->status = $status;
        try {
            $updateModel->save();
          $result['status']='Ok';
          $result['status_code']='200';
          $result['message']='Purchase Message Updated Successfully!';
          $result['inserted_id']=$id;
        } catch (\Exception $e) {
            $result['status']='Failed';
            $result['status_code']='300';
            $result['message']="Purchase Message Updation Unsuccessfull.";
            $result['inserted_id']=$id;
        }

        $response=array();
        array_push($response, $result);
        return json_encode($response);

    }
    public function purchasemessagedeleteApi(Request $request)
    {
        $id = $request->get('id');

        try {
            purchasemessage::destroy($id);
            $result['status']='Ok';
            $result['status_code']='200';
            $result['message']='Purchase Message Deleted Successfully!';
            $result['inserted_id']=$id;
        } catch (\Exception $e) {
            $result['status']='Failed';
            $result['status_code']='300';
            $result['message']='Purchase Message Updation Unsuccessfull.';
            $result['inserted_id']=$id;
        }
        $response=array();
        array_push($response, $result);
        return json_encode($response);
    }

    public function purchasemessage_get_by_id(Request $request)
    {
        $id = $request->get('id');
        $data = purchasemessage::find($id);
        return json_encode($data);
    }
}
