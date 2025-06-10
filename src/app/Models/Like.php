<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $guarded = ['*'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function itemListing(){
        return $this->belongsTo('App\Models\ItemListing');
    }

}