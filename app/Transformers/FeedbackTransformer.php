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
            'poster'    => $feedback->poster->profile->fullName(),
            'feedback'  => $feedback->getFeedback(),
            'createdAt' => $feedback->getCreatedAt(),
        ];
    }
}
