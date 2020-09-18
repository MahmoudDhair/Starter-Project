<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    public function getHasOne(){
        $usre = User::with(['phone'=>function($q){
            $q->select('code','number','user_id');
        }])->find(11);
        return response()->json($usre);
    }
}
