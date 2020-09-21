<?php

namespace App\Models;

use App\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offer'; // The of table In database that i can handle it by this model
    // all column that I can update And insert it
    protected $fillable = ['name_ar','name_en','pric' ,'photo', 'created_at' , 'updated_at', 'details_ar', 'details_en'];

    // all column that Not Appear in the response
    protected $hidden = ['created_at' , 'updated_at'];


    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OfferScope());
    }

    //public $timestamps = true; // to turn of timestamps

    ######################################## local scopes ####################################################

    public function scopeValid($q){
        $q->where('status',1);
    }


    ######################################## local scopes ####################################################



}
