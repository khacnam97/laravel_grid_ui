<?php
namespace App\Http\Controllers;

use App\Events\HelloPusherEvent;
use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MessageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function home($id) {
        $message = Message::where([['to',$id],['from', auth()->user()->id]])->orwhere([['to',auth()->user()->id],['from', $id ]])->get();
        return view('home', ['message' => $message, 'id' => $id]);
    }
    public function index()
    {
        $user_id = Auth::user()->id;
        $data = array('user_id' => $user_id);

        return view('chat.index', $data);
    }

    public function send(Request $request): \Illuminate\Http\RedirectResponse
    {
        // ...

        // message is being sent
        $message = new Message;
        $message->setAttribute('from', auth()->user()->id);
        $message->setAttribute('to', $request->id);
        $message->setAttribute('user_id', 2);
        $message->setAttribute('message', $request->message);

        $message->save();
        // want to broadcast NewMessageNotification event
//        broadcast(new HelloPusherEvent($message->message . ' ' .$message->created_at));
        broadcast(new NewMessage($message, $request->id));
        return Redirect::back()->with('message','Operation Successful !');
    }

    public function laravelEcho() {
        return view('broadcast', ['user_id' => auth()->user()->id]);
    }
}
