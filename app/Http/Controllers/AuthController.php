<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    private function validateRegister(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'email' => 'required|email',
            'password' => [
                'required',
                'min:8',
            ],
            'name' => 'required'
        ]);

        if($validator->fails())
        {
            return $validator->errors();
        }

        // TODO: add special character checking

        return true;
    }

    public function register(Request $request)
    {
        if ( $this->validateRegister($request) != true )
        {
            return response()->json($this->validateRegister($request));
        }

        $user = User::create([
            'email' => $request->email,
            'password' => $request->password,
            'name' => $request->name
        ]);

        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }
}
