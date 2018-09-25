<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

class AuthController extends Controller
{
    public function tokenFromCredentials(Guard $auth, Request $request)
	{
	    // get some credentials
	    $credentials = $request->only(['email', 'password']);

	    if ($auth->attempt($credentials)) {
	       return $token = $auth->issue();
	    }

	    return ['Invalid Credentials'];
	}


	public function refreshToken(Guard $auth)
	{
	    // auto detecting token from request.
	    $token = $auth->refresh();

	    // manually passing the token to be refreshed.
	    $token = $auth->refresh($oldToken);

	    return $token;
	}
}
