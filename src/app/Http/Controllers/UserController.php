<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
    public function update(UpdateUserRequest $request, $id)
    {
        $validated = $request->validated();

        $user = User::findOrFail($id);
        $user->update($validated);

        return redirect()->route('admin.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'User deleted successfully.');
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

         // 管理者専用画面からのリクエストの場合、デフォルトパスワードを設定
        if ($request->has('is_admin_request') && $request->is_admin_request == 'true') {
            $validated['password'] = Hash::make('0000');
        } else {
            // 通常のユーザー登録の場合は、入力されたパスワードを使用
            if (!empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            }
        }

        User::create($validated);

        return redirect()->route('admin.index')->with('success', 'User created successfully.');
    }
}
