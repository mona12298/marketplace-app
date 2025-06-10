<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_url',
    ];

    public function itemListing(){
        return $this->belongsTo('App\Models\ItemListing');
    }

    public function itemPurchase(){
        return $this->belongsTo('App\Models\ItemPurchase');
    }
}
