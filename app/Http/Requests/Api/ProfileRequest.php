<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function getFirstName()
    {
        return $this->get('firstName');
    }

    public function getLastName()
    {
        return $this->get('lastName');
    }

    public function getPreferredName()
    {
        return $this->get('preferredName');
    }

    public function getLocation()
    {
        return $this->get('location');
    }

    public function getTwitter()
    {
        return $this->get('twitter');
    }

    public function getGithub()
    {
        return $this->get('github');
    }

    public function getBlog()
    {
        return $this->get('blog');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName'       => 'sometimes|required|string',
            'lastName'        => 'sometimes|required|string',
            'preferredNName'  => 'sometimes|required|string',
            'location'        => 'sometimes|required|string',
            'github'          => 'sometimes|required|url',
            'twitter'         => 'sometimes|required|url',
            'blog'            => 'sometimes|required|url',
        ];
    }
}
