<?php

namespace App\Http\Controllers;

use App\Sign;
use App\Thread;
use Illuminate\Http\Request;
use Auth;

class SignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sign(Thread $thread)
    {

        $sign = new Sign;
        $sign->user_id = Auth::user()->id;
        $sign->thread_id = $thread->id;
        $sign->save();

        return back();
    }

    public function del(Thread $thread)
    {

        Sign::where('thread_id', $thread->id)
            ->where('user_id', Auth::user()->id)
            ->delete();

        return back();
    }
}
