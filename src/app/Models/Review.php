<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
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
        'evaluation',
        'comment',
    ];

    /**
     * リレーションの定義
     * レビューをしたユーザーを取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * リレーションの定義
     * レビューされた店舗を取得
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
