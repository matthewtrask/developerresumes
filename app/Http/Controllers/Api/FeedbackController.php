<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FeedbackRequest;
use App\Mail\FeedbackReceived;
use App\Models\Feedback;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

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

        $this->sendFeedbackEmail($request->user());
        
        return $this->response->setStatusCode(201);
    }

    private function sendFeedbackEmail($user)
    {
        return Mail::to($user)
            ->send(new FeedbackReceived($user));
    }
}
