<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LaunchSoftware;
use Illuminate\Http\Request;

class LaunchSoftwareController extends Controller
{
    public function launchsoftwareinsertApi(Request $request)
    {
        $newRecord = new LaunchSoftware;
        $newRecord->name = $request->get('name');
        $newRecord->phone_number = $request->get('phone_number');
        $newRecord->email = $request->get('email');
        $newRecord->amount = $request->get('amount');
        $newRecord->discount = $request->get('discount');
        $newRecord->feature = $request->get('feature');
       // $newRecord->status = $request->get('status');
        try {
            if ($newRecord->save()) {
                $id = $newRecord->getkey();
                $result['status'] = 'Ok';
                $result['status_code'] = '200';
                $result['message'] = ' Launch Software Inserted Successfully!';
                $result['inserted_id'] = $id;
            } else {
                $id = $newRecord->getkey();
                $result['status'] = 'Failed';
                $result['status_code'] = '300';
                $result['message'] = ' Launch Software Insertion Unsuccessfull!';
                $result['inserted_id'] = $id;
            }
        } catch (\Exception $e) {
            return "Launch Software Insertion Failed";
        }
        $response = array();
        array_push($response, $result);
        return json_encode($response);
    }
    public function launchsoftwaredeleteApi(Request $request)
    {
        $id = $request->get('id');
        try {
            LaunchSoftware::destroy($id);
            $result['status'] = 'Ok';
            $result['status_code'] = '200';
            $result['message'] = 'Message Deleted Successfully!';
            $result['inserted_id'] = $id;
        } catch (\Exception $e) {
            $result['status'] = 'Failed';
            $result['status_code'] = '300';
            $result['message'] = 'Message Deletion Unsuccessfull.';
            $result['inserted_id'] = $id;
        }
        $response = array();
        array_push($response, $result);
        return json_encode($response);
    }

    public function launchsoftware_get_by_id(Request $request)
    {
        $id = $request->get('id');
        $data = LaunchSoftware::find($id);
        return json_encode($data);
    }

   

    public function getlaunchsoftwares(Request $request)
    {

        $data['launch_softwares'] = LaunchSoftware::all();
        return view('launch_softwares', $data);
    }

    public function delete_launchsoftware(Request $request)
    {
        $id = $request->get('id');
        LaunchSoftware::destroy($id);
        return redirect('/launch_softwares');
    }

    public function addnewlaunchsoftware(Request $request)
    {
        $newRecord = new LaunchSoftware;
        $newRecord->name = $request->get('name');
        $newRecord->phone_number = $request->get('phone_number');
        $newRecord->email = $request->get('email');
        $newRecord->price = $request->get('price');
        $newRecord->discount = $request->get('discount');
        $newRecord->feature = $request->get('feature');
        $newRecord->status = $request->get('status');
        $newRecord->save();
        return redirect('/launch_softwares');
    }
    public function updatelaunch_softwareStatus(Request $request)
    {
        $id = $request->get('id');
        $status = $request->get('status');
        try {
            $user = LaunchSoftware::find($id);
            $user->status = $status;
            if ($user->save()) {
                return response()->json(['success' => 'User status change successfully.']);
            } else {
                return response()->json(['failed' => 'User status change failed.']);
            }
        } catch (\Exception $e) {
            return response()->json(['failed' => $e]);
        }
    }
}
