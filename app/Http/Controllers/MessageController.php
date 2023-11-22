<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function messageinsertApi(Request $request)
    {
        $newRecord = new Message;
        $newRecord->user_id = $request->get('user_id');
        $newRecord->content = $request->get('content');
        $newRecord->amount = $request->get('amount');
        $newRecord->slug = $request->get('slug');
         $newRecord->expiry = $request->get('expiry');
        $newRecord->status = $request->get('status');
        $newRecord->file = $request->get('file');
        $newRecord->title = $request->get('title');
         $newRecord->no_of_sales = $request->get('no_of_sales');

        try {
            if ($newRecord->save()) {
                $id = $newRecord->getkey();
                $result['status'] = 'Ok';
                $result['status_code'] = '200';
                $result['message'] = ' Message Inserted Successfully!';
                $result['inserted_id'] = $id;
            } else {
                $id = $newRecord->getkey();
                $result['status'] = 'Failed';
                $result['status_code'] = '300';
                $result['message'] = ' Message Insertion Unsuccessfull!';
                $result['inserted_id'] = $id;
            }
        } catch (\Exception $e) {
            return $e;
        }
        $response = array();
        array_push($response, $result);
        return json_encode($response);
    }

    public function messageupdateApi(Request $request)
    {
        $id = $request->get('id');
        $user_id = $request->get('user_id');
        $content = $request->get('content');
        $price = $request->get('price');
        $slug = $request->get('slug');
        $expiry = $request->get('expiry');
        $status = $request->get('status');
        $file = $request->get('file');
        $title = $request->get('title');
        $updateModel = Message::find($id);
        $updateModel->user_id = $user_id;
        $updateModel->content = $content;
        $updateModel->price = $price;
        $updateModel->slug = $slug;
        $updateModel->expiry = $expiry;
        $updateModel->status = $status;
        $updateModel->file = $file;
        $updateModel->title = $title;
        try {
            $updateModel->save();
            $result['status'] = 'Ok';
            $result['status_code'] = '200';
            $result['message'] = 'Message Updated Successfully!';
            $result['inserted_id'] = $id;
        } catch (\Exception $e) {
            $result['status'] = 'Failed';
            $result['status_code'] = '300';
            $result['message'] = 'Message  Updation Unsuccessfull!';
            $result['inserted_id'] = $id;
        }
        $response = array();
        array_push($response, $result);
        return json_encode($response);
    }
    public function messagedeleteApi(Request $request)
    {
        $id = $request->get('id');

        try {
            Message::destroy($id);
            $result['status'] = 'Ok';
            $result['status_code'] = '200';
            $result['message'] = 'Message Deleted Successfully!';
            $result['inserted_id'] = $id;
        } catch (\Exception $e) {
            $result['status'] = 'Failed';
            $result['status_code'] = '200';
            $result['message'] = 'Message Deletion Unsuccessfull!';
            $result['inserted_id'] = $id;
        }
        $response = array();
        array_push($response, $result);
        return json_encode($response);
    }

    public function message_get_by_id(Request $request)
    {
        $id = $request->get('id');
        $data = message::find($id);
        return json_encode($data);
    }
    public function getmessages(Request $request)
    {
        // $data['messages'] = Message::all();
        $user_id = $request->get('user_id');

        $data['messages'] = DB::table('message')->join('user', 'message.user_id', '=', 'user.id')
        ->select('message.*', 'user.name')->where('message.user_id', '=', $user_id) ->get();
        // $data['messages'] = Message::all();
        return view('message', $data);
    }

    public function delete_messages(Request $request)
    {
        $id = $request->get('id');
        Message::destroy($id);
        return redirect('/messages');
    }

    public function addnewmessage(Request $request)
    {
        $newRecord = new Message;
        $newRecord->user_id = $request->get('user_id');
        $newRecord->content = $request->get('content');
        $newRecord->price = $request->get('price');
        $newRecord->slug = $request->get('slug ');
        $newRecord->expiry = $request->get('expiry');
        $newRecord->status = $request->get('status');
        if (isset($request->file)) {
            $fileName = time() . rand(10000, 1000000) . '.' . $request->file->extension();
            $request->file->move(public_path('files/message/'), $fileName);
            $filePath = "files/message/" . $fileName;
            $newRecord->file = $filePath;
        }
        $newRecord->title = $request->get("title");
        $newRecord->save();
        return redirect('/messages');
    }

    public function updatemessagestatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        try {
            $message = Message::find($id);
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
    public function messagelist(Request $request)
    {
        $data['messagelists'] = DB::table('message')->join('user', 'message.user_id', '=', 'user.id')
        ->select('message.*', 'user.name')->get();
        return view('messagelist',$data);
    }

    public function messagesales(Request $request){
        $data['messagesales'] = DB::table('message_lists')->join('user', 'message_lists.user_id', '=', 'user.id')
        ->select('message_lists.*', 'user.name')->get();
        return view('messagesales',$data);
    }
}