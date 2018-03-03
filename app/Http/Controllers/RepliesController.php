<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Reply;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Events\AddMessage;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($channelId, Thread $thread)
    {   
        if (Gate::denies('create', new Reply)) {
            return back()->with('warning', 'Вы добавляете сообщения слишком часто. Сделайте перерыв. :)');
        } 

        $this->validate(request(), ['body' => 'required']);

        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        event(new AddMessage(new Reply));

        return back();
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);
   
        $reply->delete();
        
        return back();
    }    
}
