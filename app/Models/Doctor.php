<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors';
    protected $fillable = ['name','title','hospital_id','created_at','updated_at'];
    protected $hidden = ['created_at','updated_at','pivot'];
    public $timestamps = true;

    ####################### Start Relation ########################################

    public function hospital(){
        return $this->belongsTo('App\Models\Hospital','hospital_id','id');
    }

    public function serves(){
        return $this->belongsToMany('App\Models\Serve','doctors_serves','doctor_id','serve_id','id','id');
    }

    ####################### End Relation ########################################

    ###########################################accessors And Mutators ################################
    public function getGenderAttribute($value){
        return $value == 1 ? 'male' : 'female';
    }

    public function getFullInforAttribute(){
        return "{$this->name} {$this->id}";
    }
}
