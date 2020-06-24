<?php

namespace App\Repositories;


interface UserRepositoryInterface
{
    
    public function allUsers();

    public function findUserById($id);

    public function saveUser($request);

    public function updateUser($request, $user);

    public function deleteUser($user);

    public function getUserWithToken($token);

    public function verifyUser($user);
}