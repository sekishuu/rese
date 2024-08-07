<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Http\Requests\Shop\CsvUploadRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $shopOwners = User::where('user_type', 'shop_owner')->get();
        $shops = Shop::with('area', 'genre', 'user')->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('admin', compact('users', 'shopOwners','shops', 'areas', 'genres'));
    }

    public function uploadForm()
    {
        return view('admin');
    }

    public function upload(CsvUploadRequest $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $file = fopen($path, 'r');
        $header = fgetcsv($file);
        $userId = Auth::id();

        while ($row = fgetcsv($file)) {
            $data = array_combine($header, $row);

            $area = Area::where('area_name', $data['地域'])->first();
            $genre = Genre::where('genre_name', $data['ジャンル'])->first();

            $imagePath = $data['画像URL'];
            $imageContents = file_get_contents($imagePath);
            $imageName = basename($imagePath);
            Storage::put('public/shop_images/' . $imageName, $imageContents);

            Shop::create([
                'shop_name' => $data['店舗名'],
                'shop_info' => $data['店舗概要'],
                'shop_image' =>$imageName,
                'area_id' => $area->id,
                'genre_id' => $genre->id,
                'user_id' => $userId,
            ]);
        }

        fclose($file);

        return redirect()->back()->with('success', 'CSVファイルのデータがインポートされました。');
    }
}
