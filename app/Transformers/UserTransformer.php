<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'profile',
    ];

    public function transform(User $user)
    {
        return [
            'id' => $user->userId(),
            'email' => $user->getEmail(),
        ];
    }

    public function includeProfile(User $user)
    {
        return $this->item($user->profile, new ProfileTransformer());
    }
}
