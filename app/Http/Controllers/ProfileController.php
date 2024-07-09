<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->only(['email', 'name', 'role', 'avatar']);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->user()->id)],
        ]);

        $request->user()->update($validated);
        return response()->json(['success' => 'Profile updated successfully']);
    }

    public function uploadProfileImage(Request $request)
    {
        if ($request->hasFile('profile_picture')) {
            $link = Storage::put('/photos', $request->file('profile_picture'));
            $previousLink = $request->user()->getRawOriginal('avatar');

            $request->user()->update(['avatar' => $link]);
            Storage::delete($previousLink);
            return response()->json(['success' => 'Profile image uploaded successsfully']);
        }
    }
}
