<?php

namespace App\Http\Controllers\Api;

use App\Transformers\UserTransformer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
