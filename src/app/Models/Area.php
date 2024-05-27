<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'area_name',
    ];

    /**
     * リレーションの定義
     * エリアが持つ店舗を取得
     */
    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
}
