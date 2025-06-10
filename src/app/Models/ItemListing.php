<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'condition',
        'item_name',
        'brand_name',
        'description',
        'price',
        'like_count',
        'comment_count',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function categories(){
        return $this->belongsToMany('App\Models\Category', 'category_item_listing');
    }

    public function images(){
        return $this->hasMany('App\Models\Image');
    }

    public function likes(){
        return $this->hasMany('App\Models\Like');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    public function purchase(){
        return $this->hasOne('App\Models\ItemPurchase');
    }

    public const CONDITION_LABELS = [
        0 => '良好',
        1 => '目立った傷や汚れなし',
        2 => 'やや傷や汚れあり',
        3 => '状態が悪い',
    ];

    public function getConditionLabelAttribute(): string {
        return self::CONDITION_LABELS[$this->condition] ?? '不明';
    }

    public function scopeKeywordSearch($query, $keyword){
        if (!empty($keyword)) {
            $query->where('item_name', 'like', '%' . $keyword . '%');
        }
        return $query;
    }
}
