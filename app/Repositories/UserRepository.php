<?php

namespace App\Repositories;

use App\Traits\ApiResponser;
use App\User;


class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function allUsers(){
        return $this->user::all();
    }

    public function findUserById($id){
        return $this->user::findOrFail($id);
    }

    public function saveUser($request){
        
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationCode();
       
        return User::create($data);
    }

    public function updateUser($request, $user){
       
        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        
    }
    
    public function deleteUser($user){
        return $user->delete();
    }

    
}