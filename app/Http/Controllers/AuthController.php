<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $this->middleware('jwt', ['except' => ['login', 'signup', 'refresh']]);
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
     * Sign up a new user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(Request $request)
    {
        try {
            $user = new User;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->name = $request->name;
            $user->suffix = $request->suffix;
            $user->gender = $request->gender;
            $user->save();
        } catch (\Exception $ex) {
            return response()->json(['error' => 'There was an error in your request'], 400);
        }
        return response()->json(['success' => 'User signed up correctly'], 200);
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
