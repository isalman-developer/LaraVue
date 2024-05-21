<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * This function is used to fetch all of the users from User Model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $users = User::latest()->get();
        return $users;
    }

    /**
     * function to insert data in model
     *
     * @return \App\Models\User
     */
    public function store()
    {
        request()->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8'
        ]);

        return User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => bcrypt(request()->password),
        ]);
    }

    /**
     * update function to update an existing user
     *
     * @param User $user
     * @return \App\Models\User
     */
    public function update(User $user)
    {
        request()->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|min:8'
        ]);

        $user->update([
            'name' => request()->name,
            'email' => request()->email,
            'password' => request()->password ? bcrypt(request()->password) : $user->password,
        ]);

        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent();
    }
}
