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
}
