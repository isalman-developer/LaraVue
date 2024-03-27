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
        return User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => bcrypt(request()->password),
        ]);
    }
}
