<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * This function is used to fetch all of the users from User Model.
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function index()
    {
        $users = User::query()
            ->when(request('query'), function ($query, $searchQuery) {
                $query->where('name', 'like', "%" . $searchQuery . "%");
            })
            ->latest()
            ->paginate();
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

    /**
     * function to delete a user
     *
     * @param User $user
     * @return void
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent();
    }

    /**
     * function to change the role of the user
     *
     * @param User $user
     * @return void
     */
    public function changeRole(User $user)
    {
        $user->update([
            'role' => request('role')
        ]);
        return response()->json(['success' => true]);
    }

    /**
     * Function to delete users in bulk
     *
     * @return void
     */
    public function bulkDelete()
    {
        User::whereIn('id', request('ids'))->delete();
        return response()->json(['success' => 'Users deleted successfully!!']);
    }
}
