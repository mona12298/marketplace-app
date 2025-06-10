<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_listing_id',
        'payment'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function itemListing(){
        return $this->belongsTo('App\Models\ItemListing');
    }

    public function images(){
        return $this->hasMany('App\Models\Image');
    }

    public const PAYMENT_LABELS = [
        1 => 'コンビニ支払い',
        2 => 'カード支払い',
    ];
    public function getPaymentLabelAttribute(){
        return self::PAYMENT_LABELS[$this->payment] ?? '不明';
    }

}
