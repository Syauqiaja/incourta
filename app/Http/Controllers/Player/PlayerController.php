<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();
        return view('player.profile', compact('user'));
    }

    public function edit(Request $request)
    {
        $user = $request->user();
        return view('player.profile-edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        // Validate all fields
        $validatedData = $request->validate([
            // User fields
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            
            // Player fields
            'phone_number' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'category' => 'nullable|string',
            'instagram' => 'nullable|string|max:255',
            'reclub' => 'nullable|string|max:255',
            
            // Avatar upload
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update user data
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        // Prepare player data
        $playerData = [
            'phone_number' => $validatedData['phone_number'],
            'city' => $validatedData['city'],
            'nik' => $validatedData['nik'],
            'category' => $validatedData['category'] ?? null,
            'instagram' => $validatedData['instagram'] ?? null,
            'reclub' => $validatedData['reclub'] ?? null,
        ];

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '_' . $user->id . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = $avatar->storeAs('uploads/players', $avatarName, 'public');
            $playerData['photo'] = '/storage/' . $avatarPath;
            
            // Delete old avatar if exists
            if ($user->player && $user->player->photo) {
                $oldPath = str_replace('/storage/', '', $user->player->photo);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
        }

        // Update or create player record
        if ($user->player) {
            $user->player->update($playerData);
        } else {
            $user->player()->create($playerData);
        }

        return redirect()->route('player.profile')->with('success', 'Profile updated successfully.');
    }
}
