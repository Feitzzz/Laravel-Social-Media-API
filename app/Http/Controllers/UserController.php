<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Resources\UserWithPostResource;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Show all users in the db 
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    // Show a user and their posts created
    public function show(User $user)
    {
        // $user = User::where('id' , $user->id)->with('posts')->withCount('posts')->first();
        $user = User::where('id', $user->id)
            ->with(['posts' => function ($query) {
                $query->with('comments')->withCount('comments');
            }])
            ->withCount('posts')
            ->first();
        return new UserWithPostResource($user);
    }

    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());

        $avatarPath = Storage::disk('public')->put('user_avatars' , $request->avatar);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'avatar_path' => $avatarPath
        ]);

        $token = $user->createToken('myapitoken')->plainTextToken;

        $response = [
            'user' => new UserResource($user),
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(loginUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Invalid Credentials'
            ], 401);
        }

        $token = $user->createToken('myapitoken')->plainTextToken;

        $response = [
            'user' => new UserResource($user),
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return response([
            'message' => 'Logged Out'
        ], 200);
    }
}
