<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    /**
     * @var Response
     */
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function create(ProfileRequest $request)
    {
        $profile = new Profile();
        $profile->setUserId($request->user()->userId());
        $profile->setFirstName($request->getFirstName());
        $profile->setLastName($request->getLastName());
        $profile->setLocation($request->getLocation());
        $profile->setPreferredName($request->getPreferredName());
        $profile->setTwitter($request->getTwitter());
        $profile->setGithub($request->getGithub());
        $profile->setBlog($request->getBlog());

        $profile->save();

        return $this->response->setStatusCode(201)->setContent('Profile was completed!');
    }

    public function edit(ProfileRequest $request)
    {
        $profile = Profile::byUserId($request->user()->userId())->first();
        $profile->setUserId($request->user()->userId());
        $profile->setFirstName($request->getFirstName());
        $profile->setLastName($request->getLastName());
        $profile->setLocation($request->getLocation());
        $profile->setPreferredName($request->getPreferredName());
        $profile->setTwitter($request->getTwitter());
        $profile->setGithub($request->getGithub());
        $profile->setBlog($request->getBlog());

        $profile->save();

        return $this->response->setStatusCode(202)->setContent('Profile was edited!');
    }
}
