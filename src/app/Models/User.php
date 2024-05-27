<?php

namespace App\Models;

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
        'user_type',
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
     // 管理者かどうかをチェックするメソッド
    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }

    // 店舗代表者かどうかをチェックするメソッド
    public function isShopOwner()
    {
        return $this->user_type === 'shop_owner';
    }

    // 一般ユーザーかどうかをチェックするメソッド
    public function isGeneralUser()
    {
        return $this->user_type === 'general';
    }

    /**
     * リレーションの定義
     */

    // ユーザーが持つレビューを取得
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // ユーザーがお気に入りにした店舗を取得
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // ユーザーの予約を取得
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // ユーザーが作成した店舗を取得
    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
}
