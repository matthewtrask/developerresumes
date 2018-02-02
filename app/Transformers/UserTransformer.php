<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'profile',
        'resume',
        'feedback'
    ];

    public function transform(User $user)
    {
        return [
            'id' => $user->userId(),
            'email' => $user->getEmail(),
        ];

        return [];
    }

    public function includeProfile(User $user)
    {
        if (!is_null($user->profile)) {
            return $this->item($user->profile, new ProfileTransformer());
        }

        return $this->null();
    }

    public function includeResume(User $user)
    {
        if (!is_null($user->resume)) {
            return $this->item($user->resume, new ResumeTransformer());
        }

        return $this->null();
    }

    public function includeFeedback(User $user)
    {
        if (!is_null($user->resume)) {
            return $this->collection($user->resume->feedback, new FeedbackTransformer());
        }

        return $this->null();
    }
}
