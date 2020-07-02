<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Mail\UserCreated;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ApiController;
use App\Transformers\UserTransformer;

class UserController extends ApiController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

        $this->middleware('transform.input:' . UserTransformer::class)->only(['store', 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->all();

        return $this->showAll($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = $this->userService->storeRules();

        $this->validate($request, $rules);

        $user = $this->userService->save($request);

        return $this->showOne($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userService->findById($id);

        return $this->showOne($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->userService->findById($id);

        $rules = $this->userService->updateRules($user);

        $this->validate($request, $rules);

        // if (!$user->isDirty()) {
        //     return $this->errorResponse('You need to specify a different value to update', 422);  
        // }
        $this->userService->update($request, $user);

        return $this->showOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->userService->findById($id);

        $this->userService->delete($user);

        return $this->showOne($user);
    }

    public function verify($token)
    {

        $user = $this->userService->getUserWithToken($token);

        $this->userService->verifyUser($user);

        return $this->showMessage('Account is verified');
    }

    public function resend(User $user)
    {
        if ($user->isVerified()) {
            return $this->errorResponse('Account is allready verified', 409);
        }
        $this->userService->sendEmail($user->email, new UserCreated($user));

        return $this->showMessage('Verification email has been resend');
    }
}
