<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Auth;

class SocialController extends Controller
{
    public function redirectToProvider($service){
        return Socialite::driver($service)->redirect();
    }

    public function handleProviderCallback($service)
    {

       $user = Socialite::driver($service)->stateless()->user();
        dd($user->token);



    }
}
