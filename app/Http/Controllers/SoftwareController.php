<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\software;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SoftwareController extends Controller
{
    public function softwareinsertApi(Request $request)
    {
        $newRecord = new software;
        $newRecord->name = $request->get('name');
        if (isset($request->image)) {
            $imageName = time() . rand(10000, 1000000) . '.' . $request->image->extension();
            $request->image->move(public_path('images/software/'), $imageName);
            $imageimagePath = "images/software/" . $imageName;
            $newRecord->image = $imageimagePath;
        } else {
            $newRecord->image = "na";
        }
        $newRecord->description = $request->get('description');
        $newRecord->price = $request->get('price');
        $newRecord->discounted_price = $request->get('discounted_price');
        $newRecord->features = $request->get('features');
        try {
            if ($newRecord->save()) {
                $id = $newRecord->getKey();
                $result['status'] = 'Ok';
                $result['status_code'] = "200";
                $result['message'] = 'Software Inserted Successfully!';
                $result['inserted_id'] = $id;
            } else {
                $id = $newRecord->getkey();
                $result['status'] = 'Failed';
                $result['status_code'] = '300';
                $result['message'] = ' Software Insertion Unsuccessfull!';
                $result['inserted_id'] = $id;
            }
        } catch (\Exception $e) {
            return "User Insertion Failed";
        }
        $response = array();
        array_push($response, $result);
        return json_encode($response);
    }

    public function get_latest_software(Request $request){
      
        $software=software::where('features','=','latest')->get();
        if (count($software) == 0) {
            $result['status'] = 'Failed';
            $result['status_code'] = '300';
            $result['message'] = 'Latest Software Not Found!';
        } else {
            $result['status'] = 'Ok';
            $result['status_code'] = '200';
            $result['message'] = 'Latest Software Found!';
            $result['software'] = $software;
        }

        return json_encode($result);
    }
    public function get_featured_software(Request $request){
       
        $software=software::where('features','=','featured')->get();
        if (count($software) == 0) {
            $result['status'] = 'Failed';
            $result['status_code'] = '300';
            $result['message'] = 'Features Software Not Found!';
        } else {
            $result['status'] = 'Ok';
            $result['status_code'] = '200';
            $result['message'] = 'Features Software Found!';
            $result['software'] = $software;
        }

        return json_encode($result);
    }

    public function softwareupdateApi(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        if (isset($request->image)) {
            $imageName = time() . rand(10000, 1000000) . '.' . $request->image->extension();
            $request->image->move(public_path('images/software/'), $imageName);
            $imageimagePath = "images/software/" . $imageName;
            $image = $imageimagePath;
        } else {
            $image = "na";
        }
        $description = $request->get('description');
        $price = $request->get('price');
        $discounted_price = $request->get('discounted_price');
        $features = $request->get('features');
        $updateModel = software::find($id);
        $updateModel->name = $name;
        $updateModel->imageimagePath = $image;
        $updateModel->description = $description;
        $updateModel->price = $price;
        $updateModel->discounted_price = $discounted_price;
        $updateModel->features = $features;

        try {
            $updateModel->save();
            $result['status'] = 'Ok';
            $result['status_code'] = "200";
            $result['message'] = 'Software Updated Successfully!';
            $result['inserted_id'] = $id;
        } catch (\Exception $e) {

            $result['status'] = 'Failed';
            $result['status_code'] = "300";
            $result['message'] = 'Software Updation Unsuccessfull.';
            $result['inserted_id'] = $id;
        }

        $response = array();
        array_push($response, $result);
        return json_encode($response);
    }

    public function softwaredeleteApi(Request $request)
    {
        $id = $request->get('id');

        try {
            Software::destroy($id);
            $result['status'] = 'Ok';
            $result['status_code'] = "200";
            $result['message'] = 'Software Deleted Successfully!';
            $result['inserted_id'] = $id;
        } catch (\Exception $e) {
            $result['status'] = 'Failed';
            $result['status_code'] = "300";
            $result['message'] = 'Software Deletion Unsuccessfull.';
            $result['inserted_id'] = $id;
        }
    }
    public function software_get_by_id(Request $request)
    {
        $id = $request->get('id');
        $data = software::find($id);
        return json_encode($data);
    }

    public function getSoftware(Request $request)
    {
        $data['softwares'] = software::all();
        return view('software', $data);
    }
    public function delete_software(Request $request)
    {
        $id = $request->get('id');
        software::destroy($id);
        return redirect('/softwares');
    }
    public function updatesoftwares(Request $request, $id)
    {
        $user = software::find($id);
        $user->name = $request->input('name');
        $user->image = $request->input('image');
        $user->description = $request->input('description');
        $user->amount = $request->input('amount');
        $user->discounted_price = $request->input('discounted_price');
        $user->features = $request->input('features');

        $user->update();

        return redirect('/softwares')->with('success', 'Software Updated successfully!');
    }
    public function addnewsoftware(Request $request)
    {
        $newRecord = new software;
        $newRecord->name = $request->get('name');
        if (isset($request->image)) {
            $imageName = time() . rand(10000, 1000000) . '.' . $request->image->extension();
            $request->image->move(public_path('images/software/'), $imageName);
            $imageimagePath = "images/software/" . $imageName;
            $newRecord->image = $imageimagePath;
        }
        $newRecord->description = $request->get('description');
        $newRecord->amount = $request->get('amount');
        $newRecord->discounted_price = $request->get('discounted_price');
        $newRecord->features = $request->get('features');
        $newRecord->save();
        return redirect('/softwares');
    }



    public function edit_softwares(Request $request)
    {
        $id = $request->get('id');
        $data['edit_data'] = software::find($id);
        $data['softwares'] = software::all();
        return view('software', $data);
    }
}
