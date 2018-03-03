<?php

namespace App\Listeners;

use Illuminate\Support\Facades\DB;
use App\Events\AddMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Mail\OrderShipped;

class SendLetter
{
    public function handle(AddMessage $event)
    {
        $reply = DB::table('replies')
                    ->latest()
                    ->first();

        $users = DB::table('users')
                    ->join('signs', function ($join) use ($reply) 
                    {
                        $join->on('users.id', '=', 'signs.user_id')
                        ->where('signs.thread_id', '=', $reply->thread_id);
                    })
                    ->join('threads', 'signs.thread_id', '=', 'threads.id')
                    ->get();
                
        if(count($users)){           
            Mail::to($users)->send(new OrderShipped($reply,$users[0]->title));
           
        }
    }
}
