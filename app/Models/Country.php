<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'contries';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function hospitals(){
        return $this->hasMany('App\Models\Hospital','country_id','id');
    }

    public function doctors(){
        return $this->hasManyThrough('App\Models\Doctor','App\Models\Hospital','country_id','hospital_id','id','id');
    }
}
