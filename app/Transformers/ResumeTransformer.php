<?php

namespace App\Transformers;

use App\Models\Resume;
use League\Fractal\TransformerAbstract;

class ResumeTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'profile',
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Resume $resume)
    {
        return [
            'id' => $resume->getId(),
            'link' => $resume->getLink(),
        ];
    }

    public function includeProfile(Resume $resume)
    {
        return $this->item($resume->user->profile, new ProfileTransformer());
    }
}
