<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function store($data)
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->password = encrypt($data['password']);

        return $user->save();
    }

    public function update($data)
    {
        $user = User::find($data['id']);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];

        return $user->save();
    }

    public function delete($id)
    {
        $user = User::find($id);

        return $user->delete();
    }

    public function getAllUsers()
    {
        $users = User::all();

        $remapUsers = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'password' => $user->password
            ];
        });

        return $remapUsers;
    }
}
