<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_listing_id',
        'content',
    ];

    public function itemListing(){
        return $this->belongsTo('App\Models\ItemListing');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
