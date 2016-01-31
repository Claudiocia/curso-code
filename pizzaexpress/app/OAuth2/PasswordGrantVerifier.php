<?php
/**
 * Created by PhpStorm.
 * User: ClaudioSouza
 * Date: 20/01/2016
 * Time: 21:37
 */

namespace pizzaexpress\OAuth2;


use Illuminate\Support\Facades\Auth;

class PasswordGrantVerifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }
}