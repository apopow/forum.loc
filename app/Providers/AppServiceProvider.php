<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Channel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AppServiceProvider extends ServiceProvider
{ 
    public function boot()
    {
        
       \View::composer('*', function ($view) {
            $channels = Channel::all();
            $view->with('channels', $channels);
        });

        Validator::extend('old_pwd', function ($attribute, $value, $parameters, $validator) {
                return  Hash::check($value, Auth::user()->password);
            }
        );
    }

    public function register()
    {
        //
    }
}
