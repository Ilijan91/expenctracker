<?php


namespace App\Services;


use App\Repositories\UserRepositoryInterface;
use App\Traits\ApiResponser;

class UserService 
{


    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }


    public function all(){
        return $this->userRepository->allUsers();
    }

    public function findById($id){
        return $this->userRepository->findUserById($id);
    }

    public function save($request){
        return $this->userRepository->saveUser($request);
    }

    public function storeRules(){
         $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ];

        return $rules;
    }

    public function updateRules($user){
        $rules = [
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'min:8|confirmed',
       ];

       return $rules;
    }

    public function update($request, $user){
        return $this->userRepository->updateUser($request, $user);
    }

    public function delete($user){
        return $this->userRepository->deleteUser($user);
    }
    
}