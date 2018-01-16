<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function create(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->getEmail(),
            'email' => $request->getEmail(),
            'password' => bcrypt($request->getPassword()),
        ]);

        if (!$user) {
            return $this->response->setStatusCode(500)->setContent('There was an error creating the user.');
        }

        return $this->response->setStatusCode(201)->setContent('User was created!');
    }
}
