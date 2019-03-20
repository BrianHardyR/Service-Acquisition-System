<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    //
    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index(){
        $unread=auth()->user()->unread();
        $read=auth()->user()->read();
        $sent=auth()->user()->sent;
        return view('message.index',compact('unread','read','sent'));
    }

    public function patch(Message $message){
        $message->read='true';
        $message->save();
       return back();
    }

    public function destroy(Message $message){
        $message->delete();

        return back();
    }
}
