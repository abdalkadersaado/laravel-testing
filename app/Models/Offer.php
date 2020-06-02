<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $tabel = 'offers' ;

    protected $fillable = [
        'name_ar','name_en', 'details_ar','details_en' , 'price','photo'
    ];

    protected $hidden = [];

    public $timestamps = false; 
}

