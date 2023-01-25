<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function index()
    {
        // return response()->json("User");
        return UserResource::collection(User::where('superadmin', NULL)->get());

        // return UserResource::collection(User::all());

        // $data = User::where('superadmin', '!=', 1)->get();

        // return UserResource::collection(User::paginate(1));
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function store(storeUserRequest $request)
    {
        User::create($request->validated());
        return response()->json("Saved");
    }

    public function update(storeUserRequest $request, User $user)
    {
        $user->update($request->validated());
        return response()->json("Updated");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(("Deleted"));
    }
}
