<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phone';
    protected $fillable = ['code','number','user_id'];
    protected $hidden = ['user_id'];
    public $timestamps = false;

    #################### Start Relation #########################
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    #################### End Relation ###########################
}
