<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Message;
use Auth;
use App\Events\Chat;

class MessageController extends Controller
{
    public function index()
    {   
        $users = $this->users();
        return view('admin.message.index', compact('users'));
    }

    public function users()
    {
        $current_user = Auth::id();
        $users = User::where('id','!=',$current_user)->get();
        return $users;
    }

    public function messages(Request $request)
    {
        $user_message = $request->user_id;
        $user_login  =  Auth::id();
        // $user_message = 2;
        // $user_login  =  1;
        $data = array();
        $messages = Message::where('from', $user_message)->Where('to',$user_login)->orWhere(
            function($query) use($user_login, $user_message){
                $query->where('from', $user_login)
                      ->where('to', $user_message);
            }
        )->get();
        foreach($messages as $index => $message){
            $data[$index]['id'] = $message->id;
            $data[$index]['from'] = $message->from;
            $data[$index]['to'] = $message->to;
            $data[$index]['content'] = $message->content;
            $data[$index]['date'] = date('d-m-Y H:i:s' , strtotime($message->created_at));
        }


        return response($data);
    }


    public function sendMessages(Request $request)
    {   
        $from = Auth::id();
        $to = $request->received;
        $content = $request->message;

        $message = new Message;
        $message->from = $from;
        $message->to   = $to;
        $message->content = $content;
        $message->save();

        event(new Chat($message,$from));

        return ['success' => true];
    }
}
