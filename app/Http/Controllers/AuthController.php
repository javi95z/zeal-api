<?php

namespace App\Http\Controllers;

/**
 * Class AuthController
 * @package App\Http\Controllers
 *
 * @group Authentication
 */
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login', 'refresh']]);
    }

    /**
     * Get a token via given credentials
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials))
            return response()->json('Login unauthorized', 401);
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user()->load('projects:id,name', 'tasks', 'role'));
    }
    public function payload()
    {
        return response()->json(auth()->payload());
    }

    /**
     * Log the user out and invalidate the token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
