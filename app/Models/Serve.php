<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serve extends Model
{
    protected $table = 'serves';
    protected $fillable = ['name','created_at','update_at'];
    protected $hidden = ['created_at','update_at','pivot'];
    public $timestamps = true;

    ####################### Start Relation ########################################

    public function doctors(){
        return $this->belongsToMany('App\Models\Doctor','doctors_serves','serve_id','doctor_id','id','id');
    }

    ####################### End Relation ########################################
}
