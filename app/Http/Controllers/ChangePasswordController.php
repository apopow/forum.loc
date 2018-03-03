<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;

class ChangePasswordController extends Controller
{
 
    public function __construct()
        {
            $this->middleware('auth');
        }

    public function showChangeForm()
    {
        return view('profiles.change_password');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        event(new PasswordReset($user));

        $this->guard()->login($user);

        return redirect('/home');
    }


    protected function rules()
    {
        return [
            'old_password' => 'required|old_pwd',
            'password' => 'required|confirmed|min:6|different:old_password',
        ];
    }

    protected function validationErrorMessages()
    {
        return [
            'old_password.old_pwd' => 'Old password incorrect',
        ];
    }

     public function broker()
    {
        return Password::broker();
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
