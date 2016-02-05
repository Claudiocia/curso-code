<?php

namespace pizzaexpress\Http\Controllers\Api;

use Illuminate\Http\Request;


use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use pizzaexpress\Http\Requests;
use pizzaexpress\Http\Controllers\Controller;
use pizzaexpress\Repositories\UserRepository;

class UserController extends Controller
{
    private $userRepository;

    function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function authenticated()
    {
        $id = Authorizer::getResourceOwnerId();
        return $this->userRepository->skipPresenter(false)->find($id);
    }

}
