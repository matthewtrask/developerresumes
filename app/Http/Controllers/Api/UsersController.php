<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsersController extends Controller
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @var UserTransformer
     */
    private $transformer;

    public function __construct(Response $response, UserTransformer $transformer)
    {
        $this->response = $response;
        $this->transformer = $transformer;
    }

    public function index()
    {
        $users = User::all();

        return $this->response->header('content-type', 'application/json')
            ->setStatusCode(200)
            ->setContent(fractal()->collection($users)->transformWith($this->transformer)->includeProfile()->toArray());
    }

    public function fetch(Request $request)
    {
        $user = User::find($request->user()->userId());

        return $this->response
            ->header('Content-type', 'application/json')
            ->setStatusCode(200)
            ->setContent(fractal()->item($user)->transformWith($this->transformer)
                ->includeResume()
                ->includeFeedback()
                ->includeProfile()
                ->toArray());
    }
}
