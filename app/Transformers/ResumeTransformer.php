<?php

namespace App\Transformers;

use App\Models\Resume;
use League\Fractal\TransformerAbstract;

class ResumeTransformer extends TransformerAbstract
{
    private $s3link = 'https://s3.amazonaws.com/developer-resumes/';

    protected $availableIncludes = [
        'profile',
        'feedback'
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
            'link' => $this->s3link . $resume->getLink(),
        ];
    }

    public function includeProfile(Resume $resume)
    {
        return $this->item($resume->user->profile, new ProfileTransformer());
    }

    public function includeFeedback(Resume $resume)
    {
        return $this->collection($resume->feedback, new FeedbackTransformer());
    }
}
