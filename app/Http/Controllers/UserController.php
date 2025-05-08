<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        if ($user->id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }
        return view('user.profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }
        \Log::info('Request data:', $request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        \Log::info('Validated data:', $validated);
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete('public/avatars/' . $user->avatar);
            }
            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('public/avatars', $avatarName);
            $validated['avatar'] = $avatarName;
        }

        $user->update($validated);

        return redirect()->route('user.profile', $user->id)
                         ->with('success', 'Profile updated successfully!');
    }
}