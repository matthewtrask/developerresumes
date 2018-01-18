<?php

namespace App\Transformers;

use App\Models\Profile;
use League\Fractal\TransformerAbstract;

class ProfileTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Profile $profile)
    {
        return [
            'name' => $profile->fullName(),
        ];
    }
}
