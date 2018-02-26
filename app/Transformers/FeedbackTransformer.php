<?php

namespace App\Transformers;

use App\Models\Feedback;
use League\Fractal\TransformerAbstract;

class FeedbackTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Feedback $feedback)
    {
        return [
            'id' => $feedback->getId(),
            'poster'    => $feedback->poster->profile->fullName(),
            'feedback'  => $feedback->getFeedback(),
            'moderated' => $feedback->getModerated(),
            'createdAt' => $feedback->getCreatedAt(),
            'links' => [
                'rel' => 'self',
                'uri' => 'users/' . $feedback->poster->profile->user->userId(),
                'resume' => 'resumes/' . $feedback->resume->getId(),
            ],
        ];
    }
}
