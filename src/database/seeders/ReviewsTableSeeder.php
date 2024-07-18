<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Shop;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->delete();

        $users = User::all()->keyBy('name');
        $shops = Shop::all()->keyBy('shop_name');

        $reviews = [
            [
                'user_id' => $users['一般太郎']->id,
                'shop_id' => $shops['仙人']->id,
                'evaluation' => 3,
                'comment' => '料理の提供時間が早すぎてびっくり。サラダはボリューミーでジャガイモもちも熱々でちょっとカレーがきいてて美味しい。カルパッチョとチキン南蛮も美味だった。最後に食べたきゅうりとプリンもさっぱりして美味しかった。',
            ],
            [
                'user_id' => $users['山田一般ユーザーけんじ']->id,
                'shop_id' => $shops['牛助']->id,
                'evaluation' => 1,
                'comment' => '休日13時頃の訪問。予約をしていたのでスムーズにご案内していただきましたが、KITTE内のレストランはどこも満席で並んでましたね。お時間に余裕をもって計画を立てたほうがいいかもしれません。お料理は3000円の御膳をいただきました(煮物だけ写真撮り忘れました…)。取り分けの必要がないのは助かります。どのお料理も美味しかったです、賑やかな中でゆったりしたペースで提供していただき満足感もありました。ご馳走様でした。',
            ],
            [
                'user_id' => $users['本田たかひろ']->id,
                'shop_id' => $shops['戦慄']->id,
                'evaluation' => 5,
                'comment' => '予約をして夕方頃に来店。若干早い時間だったのと平日だったせいか混み合うこともなくゆったりした雰囲気でした。アラカルトで全体的にバランス良く注文しました。まずは雅邸サラダ、伊勢海老の刺盛りを注文。どちらも彩りが良く見た目から美味しい。サラダは気持ち量が多め？刺し身は伊勢海老と他3種でどれもサイズが大きく食べ応えあり。途中で注文した寿司と肉寿司は盛り付けは綺麗だったが、値段の割に量が少なくコスパは悪い。味はまあまあ。メイン料理は美味しく、全体的に満足感のある料理でした。',
            ],
            [
                'user_id' => $users['山田一般ユーザーけんじ']->id,
                'shop_id' => $shops['ルーク']->id,
                'evaluation' => 2,
                'comment' => 'この日は、上司の還暦祝いだったのですが、4000円の飲み放題のコースのわりにはなかなか良いものがでてきたのでとてもよかったです。事前にメニューチェックしてなかったので伊勢海老がでてきてびっくりしました。肉料理もかなりおいしく、唐揚げや豚のステーキ？みたいなのがでてきたので、男性でも満足できたと思います。席が柱が端にありその分1人座れなくて残念でしたがぜひまた利用させていただきます。',
            ],
            [
                'user_id' => $users['本田たかひろ']->id,
                'shop_id' => $shops['志摩屋']->id,
                'evaluation' => 4,
                'comment' => 'まだ木曜日なのにどこの居酒屋も満席で路頭に迷っていたところ、ネットで空席があったので10分前くらいでしたが予約を入れてから来店しました。飲食店なので御手洗いはきれいな方がいいです。何よりうまいし手が混んでることがよくわかる素晴らしいお店だと思います。',
            ],
        ];

        DB::table('reviews')->insert($reviews);
    }
}
