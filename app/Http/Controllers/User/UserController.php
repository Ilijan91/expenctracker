<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;    
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

        if (!$user->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);  
        }
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
}
