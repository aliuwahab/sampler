<?php

namespace App\Http\Controllers;

use App\Http\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    use RespondsWithHttpStatus;

    public function authenticate(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {

            $token = $request->user()->createToken($request->user()->name);

            return $this->success('User Authenticated successfully', ['token' => $token->plainTextToken]);
        }

        return $this->failure('User Authentication Failed', Response::HTTP_UNAUTHORIZED );
    }

    public function logOut(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->success('User logout successfully');
    }
}
