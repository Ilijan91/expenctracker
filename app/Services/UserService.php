<?php


namespace App\Services;


use Nexmo\Laravel\Facade\Nexmo;
use Illuminate\Support\Facades\Mail;
use App\Repositories\UserRepositoryInterface;


class UserService
{


    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function all()
    {
        return $this->userRepository->allUsers();
    }

    public function findById($id)
    {
        return $this->userRepository->findUserById($id);
    }

    public function save($request)
    {
        return $this->userRepository->saveUser($request);
    }

    public function storeRules()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ];

        return $rules;
    }

    public function updateRules($user)
    {
        $rules = [
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'min:8|confirmed',
        ];

        return $rules;
    }

    public function update($request, $user)
    {
        return $this->userRepository->updateUser($request, $user);
    }

    public function delete($user)
    {
        return $this->userRepository->deleteUser($user);
    }

    public function getUserWithToken($token)
    {
        return $this->userRepository->getUserWithToken($token);
    }

    public function verifyUser($user)
    {
        return $this->userRepository->verifyUser($user);
    }

    public function sendEmail($to, $send)
    {
        return Mail::to($to)->send($send);
    }

    public function sendSms()
    {
        return Nexmo::message()->send([
            'to' => '+381665105410',
            'from' => '15556666666',
            'text' => 'You have just made new transaction'
        ]);
    }
}
