<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'shop_id',
        'reserve_date',
        'reserve_time',
        'number_of_people',
    ];

    /**
     * リレーションの定義
     * 予約したユーザーを取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * リレーションの定義
     * 予約した店舗を取得
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'shop_id', 'shop_id')->where('user_id', $this->user_id);
    }

}
