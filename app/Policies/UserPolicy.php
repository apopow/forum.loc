<?php

namespace App\Policies;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function upload(User $user, $req){
        

        return $req->id === $user->id;
    }
}
