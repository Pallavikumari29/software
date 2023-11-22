<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Isset_;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{


    //
    public function user_insertApi(Request $request)
    {
        $newRecord = new User;
        $newRecord->name = $request->get('name');
        $newRecord->phone_number = $request->get('phone_number');
        $newRecord->username = $request->get('username');

        try {
            if ($newRecord->save()) {
                $id = $newRecord->getkey();
                $result['status'] = 'Ok';
                $result['status_code'] = '200';
                $result['message'] = ' User Inserted Successfully!';
                $result['user'] = User::find($id)->get();
            } else {
                $result['status'] = 'Failed';
                $result['status_code'] = '300';
                $result['message'] = 'User Creation Failed!';
            }
        } catch (\Exception $e) {
            if ($e->getCode()) {
                $result['status'] = 'Failed';
                $result['status_code'] = '300';
                $result['message'] = 'Username Already Exist!';
             }
            return "User Insertion Failed";
        }
        $response = array();
        array_push($response, $result);
        return json_encode($response);
    }


    public function userupdateApi(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $phone_number = $request->get('phone_number');
        $display_name = $request->get('display_name');
        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');
        $about = $request->get('about');
        if (isset($request->profile_pic)) {
            $imageName = time() . rand(10000, 1000000) . '.' . $request->profile_pic->extension();
            $request->profile_pic->move(public_path('images/users/'), $imageName);
            $imageprofile_picPath = "images/users/" . $imageName;
            $profile_pic = $imageprofile_picPath;
        } else {
            $profile_pic = "na";
        }
        $updateModel = User::find($id);
        $updateModel->name = $name;
        $updateModel->phone_number = $phone_number;
        $updateModel->display_name = $display_name;
        $updateModel->username = $username;
        $updateModel->email = $email;
        $updateModel->password = $password;
        $updateModel->about = $about;
        $updateModel->profile_pic = $profile_pic;
        try {
            $updateModel->save();
            $result['status'] = 'Ok';
            $result['status_code'] = '200';
            $result['message'] = ' User updated Unsuccessfull!';
            $result['inserted_id'] = $id;
        } catch (\Exception $e) {

            $result['status'] = 'Failed';
            $result['status_code'] = '300';
            $result['message'] = ' User Updation Unsuccessfull!';
            $result['inserted_id'] = $id;
        }
        $response = array();
        array_push($response, $result);
        return json_encode($response);
    }

    public function deleteApi(Request $request)
    {
        $id = $request->get('id');

        try {
            User::destroy($id);
            $result['status'] = 'Ok';
            $result['status_code'] = '200';
            $result['message'] = ' User Deleted successfully!';
            $result['inserted_id'] = $id;
        } catch (\Exception $e) {
            $result['status'] = 'Failed';
            $result['status_code'] = '300';
            $result['message'] = ' User Deletion Unsuccessfull!';
            $result['inserted_id'] = $id;
        }
        $response = array();
        array_push($response, $result);
        return json_encode($response);
    }





    public function user_get_by_id(Request $request)
    {
        $id = $request->get('id');
        $data = user::find($id);
        return json_encode($data);
    }
    public function edit_users(Request $request)
    {
        $id = $request->get('id');
        $data['edit_data'] = user::find($id);
        $data['users'] = user::all();
        return view('user', $data);
    }

    public function delete_users(Request $request)
    {
        $id = $request->get('id');
        // $data=user::find($id);
        // $data->delete()
        user::destroy($id);
        return redirect('/users')->with('success', 'User Deleted Successfully!');
    }


    public function getUsers(Request $request)
    {
        $data['users'] = user::all();
        return view('user', $data);
    }
    public function addnewuser(Request $request)
    {
        $newRecord = new user;
        $newRecord->name = $request->name;
        $newRecord->phone_number = $request->phone_number;
        $newRecord->username = $request->username;
        $newRecord->display_name = $request->display_name;
        $newRecord->email = $request->email;
        $newRecord->status = $request->status;
        $newRecord->about = $request->about;

        $newRecord->save();
        return redirect('/users');
    }
    public function updateusers(Request $request, $id)
    {
        $user = user::find($id);
        $user->name = $request->input('name');
        $user->phone_number = $request->input('phone_number');
        $user->username = $request->input('username');
        $user->display_name = $request->input('display_name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $imageName = "images/noprofile.jpg";
        $imagePath = "images/noprofile.jpg";
        if ($request->hasFile('image')) {
            $destination = 'images/users' . $user->profile_pic;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $profile_pic = $request->file('image');
            $extension = $profile_pic->extension();
            $filename = -time() . rand(10000, 1000000) . '.' . $extension;
            $profile_pic->move(public_path('images/users'), $filename);
            $user->profile_pic = $imagePath;
        }
        $user->status = $request->input('status');
        $user->about = $request->input('about');
        $user->update();
        return redirect('/users')->with('success', 'user Updated successfully!');
    }
    public function sendOtp(Request $request)
    {
        
        $mobile = $request->mobile;
        $result['status'] = 'Ok';
        $result['status_code'] = '200';
        $result['mobile'] = $mobile;
        $result['message'] = ' OTP Sent Successfully!';
        $result['otp'] = rand(100000, 999999);
        $user = user::where('phone_number', '=', $mobile)->get();

        if (count($user) > 0 ) {
            $result['is_exist'] = 'yes';
            $result['id'] = $user[0]->id;

        } else {
            $result['is_exist'] = 'no';
            $result['id'] = 0;

        }
        return json_encode($result);
    }
    // public function verify_username(Request $request)
    // {
    //     $username = $request->username;
    //     $name = $request->name;
    //     $mobile = $request->mobile;
    //     $user = user::where('username', $request->username)->get();
    //     if (count($user) > 0) {
    //         $result['status'] = 'failed';
    //         $result['status_code'] = '300';
    //         $result['message'] = 'Username Already Exist!';
    //     } else {
    //         $newRecord = new User;
    //         $newRecord->name = $name;
    //         $newRecord->phone_number = $mobile;
    //         $newRecord->username = $username;
    //         try {
    //             if ($newRecord->save()) {
    //                 $id = $newRecord->getkey();
    //                 $result['status'] = 'Ok';
    //                 $result['status_code'] = '200';
    //                 $result['message'] = ' User Created Successfully!';
    //                 $result['inserted_id'] = $id;
    //             } else {
    //                 $result['status'] = 'Failed';
    //                 $result['status_code'] = '300';
    //                 $result['message'] = 'User Creation Failed!';
    //             }
    //         } catch (\Exception $e) {
    //             $result['status'] = 'Failed';
    //             $result['status_code'] = '300';
    //             $result['message'] = 'User Creation Failed!';
    //         }
    //     }
    //     return json_encode($result);
    // }
    public function verify_username(Request $request)
    {
       // $username = $request->username;
        $user = user::where('username', $request->username)->get();
        if (count($user) > 0) {
            $result['status'] = 'failed';
            $result['status_code'] = '300';
            $result['message'] = 'Username Already Exist!';
            $result['username'] = $user[0]->username;
        } else {
            $result['status'] = 'success';
            $result['status_code'] = '200';
            $result['message'] = 'Username Does Not Exist!';
        }
        return json_encode($result);
    }
    public function get_user_detail(Request $request)
    {
        $mobile = $request->get('mobile');
        $user = user::where('phone_number', '=', $mobile)->get();

        if (count($user) == 0) {
            $result['status'] = 'Failed';
            $result['status_code'] = '300';
            $result['message'] = 'User Not Found!';
        } else {
            $result['status'] = 'Ok';
            $result['status_code'] = '200';
            $result['message'] = 'User Found!';
            $result['user'] = $user;
        }

        return json_encode($result);
    }
    public function updateUserStatus(Request $request)
    {
        $id = $request->get('id');
        $status = $request->get('status');
        try {
            $user = user::find($id);
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
