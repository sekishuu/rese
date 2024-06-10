<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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

        User::create($validated);

        return redirect()->route('admin.index')->with('success', 'User created successfully.');
    }
}
