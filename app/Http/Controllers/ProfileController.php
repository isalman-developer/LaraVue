<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserPassword;
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

    public function changeUserPassword(Request $request, UpdateUserPassword $updateUserPassword)
    {
        $updateUserPassword->update($request->user(), [
            'current_password' => $request->current_password,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation
        ]);

        return response()->json(['success' => 'Password changed successfully.']);
    }
}
