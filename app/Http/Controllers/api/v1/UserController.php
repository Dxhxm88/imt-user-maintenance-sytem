<?php

namespace App\Http\Controllers\api\v1;

use App\Constants\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, UserService $userService)
    {
        $users = $userService->getAllUsers();

        return respond(Response::ERR_CODE_SUCCESS, "", $users);
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
    public function store(StoreUserRequest $request, UserService $userService)
    {
        $validated = $request->validated();

        $createdUser = $userService->store($validated);

        if ($createdUser) {
            return respond(Response::ERR_CODE_SUCCESS, "");
        }

        return respond(Response::ERR_CODE_FAILED, "Create User Failed");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(UpdateUserRequest $request, UserService $userService)
    {
        $validated = $request->validated();

        $updatedUser = $userService->update($validated);

        if ($updatedUser) {
            return respond(Response::ERR_CODE_SUCCESS, "");
        }

        return respond(Response::ERR_CODE_FAILED, "Update User Failed");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteUserRequest $request, UserService $userService)
    {
        $validated = $request->validated();

        $deletedUser = $userService->delete($validated['id']);

        if ($deletedUser) {
            return respond(Response::ERR_CODE_SUCCESS, "");
        }

        return respond(Response::ERR_CODE_FAILED, "Delete User Failed");
    }
}
