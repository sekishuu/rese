<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_name',
        'shop_address',
        'tel',
        'shop_info',
        'shop_image',
        'area_id',
        'genre_id',
    ];

    /**
     * リレーションの定義
     * 店舗のエリアを取得
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * リレーションの定義
     * 店舗のジャンルを取得
     */
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    /**
     * リレーションの定義
     * 店舗のレビューを取得
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * リレーションの定義
     * 店舗のお気に入りを取得
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * リレーションの定義
     * 店舗の予約を取得
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
