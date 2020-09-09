<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function showUsername(){
        return 'Mahmoud Dhair';
    }

    public function getIndex(){
        return view('welcome');
    }
}
