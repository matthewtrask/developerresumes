<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Response;

class FeedbackController extends Controller
{
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function create(FeedbackRequest $request)
    {
        $userId = $request->user()->userId();

        $feedback = new Feedback();
        $feedback->setResumeId($request->getResumeId());
        $feedback->setPosterId($userId);
        $feedback->setFeedback($request->getFeedback());

        $feedback->save();

        return $this->response->setStatusCode(201);
    }
}
