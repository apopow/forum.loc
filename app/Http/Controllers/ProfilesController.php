<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Image;
use Auth;

class ProfilesController extends Controller
{
    public function show(User $user)
    { 
        return view('profiles.show', [
            'profileUser' => $user,
            'threads' => $user->threads()->paginate(30),
        ]);
    }

    public function uploadAvatar(Request $request)
    {
        $user = Auth::user();

        if($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            Image::make($avatar)->resize(300,300)->save( public_path('/uploads/avatars/' . $filename) );

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }

        return view('profiles.show', array('profileUser' => $user,'threads' => $user->threads()->paginate(30),));
    }
}
