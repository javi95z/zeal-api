<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validate data
        $request->validate([
            'email'     => 'required|string|email',
            'password'  => 'required|string'
        ]);

        $credentials = request(['email', 'password']);
        // Return error if credentials do not match
        if (!Auth::attempt($credentials))
            return response()->json(['message' => 'Unauthorized'], 401);

        $user = $request->user();

        // Return error if user is inactive
        if (!$user->active)
            return response()->json(['message' => 'User is inactive'], 401);

        // Return user data
        return response()->json(['user' => $user], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(Request $request)
    {
        // Validate data
        $request->validate([
            'email'     => 'required|string|email|unique:users',
            'password'  => 'required|string',
        ]);

        // Generate random API token
        $apiToken = Str::random(60);

        // Create an insert the user
        $user = new User;
        $user->email = $request->email;
        $user->api_token = $apiToken;
        $user->password  = bcrypt($request->password);
        $user->save();

        return response()->json([
            'message' => 'Successfully created user',
            'token' => $apiToken
        ], 201);
    }
}
