<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Message;
use App\Sent;
class MessagesController extends Controller
{
    public function index(){
        $data['unreadMessages'] = Message::where('read', 0)->get()->count();
        return view('contents.message', $data);
    }

    public function messageInbox(){
        $data['messages'] = Message::orderBy('created_at', 'DESC')->get();
        return view('contents.message-inbox', $data)->render();
    }

    public function messageSent(){
        $data['messages'] = Sent::orderBy('created_at', 'DESC')->get();
        return view('contents.message-sent', $data)->render();
    }
    public function messageTrash(){
        $data['messages'] = Message::onlyTrashed()->orderBy('created_at', 'DESC')->get();
        return view('contents.message-trash', $data)->render();
    }

    public function send(Request $request){
        $validate = $request->validate([
            'to' => 'required|string|email',
            'subject' => 'string',
        ]);
        
        Sent::create($request->only(['to', 'subject', 'message']));
        Mail::send(array(), array(), function ($message) use ($request) {
            $message->to($request->to)->subject($request->subject)->setBody($request->message, 'text/html');
        });
        return response()->json(array('success' => true, 'msg' => 'Message Sent.'));
    }

    public function read($id){
        $message = Message::find($id);
        $message->read = 1;
        $message->save();

        return view('contents.message-read', $message)->render();
    }
    public function prev($id){
        $message = Message::where('id','<',$id)->first();
        if($message){
            $message->read = 1;
            $message->save();
            return view('contents.message-read', $message)->render();
        }
    }
    public function next($id){
        $message = Message::where('id','>',$id)->first();
        if($message){
            $message->read = 1;
            $message->save();
            return view('contents.message-read', $message)->render();
        }
    }
    public function delete(Request $request){
        $ids = explode(',', $request->ids);
        $delete = Message::whereIn('id',$ids)->delete();

        return $delete;
    }
    
    public function delete_sent(Request $request){
        $ids = explode(',', $request->ids);
        $delete = Sent::whereIn('id',$ids)->delete();

        return $delete;
    }

    public function delete_force(Request $request){
        $ids = explode(',', $request->ids);
        $delete = Message::whereIn('id',$ids)->forceDelete();

        return $delete;
    }
}
