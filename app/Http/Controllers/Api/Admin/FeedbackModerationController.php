<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FeedbackModerationRequest;
use App\Mail\FeedbackModerated;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class FeedbackModerationController extends Controller
{
    /**
     * @var Response
     */
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function edit(FeedbackModerationRequest $request)
    {
        $feedback = Feedback::byId()->first();

        $feedback->setModerated(1);

        $feedback->save();

        $this->sendModerationEmail($feedback->poster);

        return $this->response->setStatusCode(202)->setContent('Feedback was moderated');
    }

    private function sendModerationEmail(User $user)
    {
        return Mail::to($user->getEmail())
            ->send(new FeedbackModerated($user));
    }
}
