<?php

namespace App\Repositories;

use App\User;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function allUsers()
    {
        return $this->user::all();
    }

    public function findUserById($id)
    {
        return $this->user::findOrFail($id);
    }

    public function saveUser($request)
    {

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = $this->user::UNVERIFIED_USER;
        $data['verification_token'] = $this->user::generateVerificationCode();

        return $this->user::create($data);
    }

    public function updateUser($request, $user)
    {
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('spending_goal')) {
            $user->spending_goal = $request->spending_goal;
        }

        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = $this->user::UNVERIFIED_USER;
            $user->verification_token = $this->user::generateVerificationCode();
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('notification')) {
            $user->notification = $request->notification;
        }

        $user->save();
    }

    public function deleteUser($user)
    {
        return $user->delete();
    }

    public function getUserWithToken($token)
    {
        return $this->user::where('verification_token', $token)->firstOrFail();
    }

    public function verifyUser($user)
    {
        $user->verified = User::VERIFIED_USER;
        $user->verification_token = null;
        $user->save();
    }
}
