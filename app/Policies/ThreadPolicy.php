<?php

namespace App\Policies;
use App\Thread;
use App\User;
use App\Sign;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Thread $thread)
    {
        return $thread->user_id === $user->id;
    }
    public function sign(User $user, Thread $thread)
    {
    	$sign = Sign::where('thread_id',$thread->id)
					->where('user_id', $user->id)
    				->first();
    			
        return ($sign ? false : true);
    }
}
