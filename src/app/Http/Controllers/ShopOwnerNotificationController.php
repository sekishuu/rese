<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ShopOwnerNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ShopOwnerNotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        $request->validate([
            'recipients' => 'required|array',
            'recipients.*' => 'exists:users,id',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $recipients = $request->recipients;
        $subject = $request->subject;
        $body = $request->body;

        foreach ($recipients as $userId) {
            $user = User::find($userId);
            if ($user) {
                Mail::to($user->email)->send(new ShopOwnerNotification($subject, $body));
            }
        }

        return redirect()->route('shop-owner.index')->with('success', 'お知らせメールを送信しました。');
    }
}
