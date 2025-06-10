<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function myPage(){
        return $this->hasOne('App\Models\MyPage');
    }

    public function itemListings(){
        return $this->hasMany('App\Models\ItemListing');
    }

    public function itemPurchases(){
        return $this->hasMany('App\Models\ItemPurchase');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    public function likedListings()
    {
        return $this->belongsToMany(ItemListing::class, 'likes','user_id', 'item_listing_id')
        ->withTimestamps();
    }
}
