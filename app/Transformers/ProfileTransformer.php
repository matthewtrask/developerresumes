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
            'name'           => $profile->fullName(),
            'firstName'      => $profile->getFirstName(),
            'lastName'       => $profile->getLastName(),
            'preferredName'  => $profile->getPreferredName(),
            'email'          => $profile->getEmail(),
            'location'       => $profile->getLocation(),
            'blog'           => $profile->getBlog(),
            'twitter'        => $profile->getTwitter(),
            'github'         => $profile->getGithub(),
            'githubUsername' => $profile->getGithubUsername(),
        ];
    }
}
