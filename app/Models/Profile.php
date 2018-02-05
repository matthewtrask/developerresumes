<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $table = 'profiles';

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeByUserId(Builder $query, int $userId)
    {
        return $query->where('user_id', '=', $userId);
    }

    public function fullName()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getEmail() : string
    {
        return $this->user->getEmail();
    }

    public function getPreferredName() : string
    {
        return $this->preferred_name;
    }

    public function getLocation() : string
    {
        return $this->location;
    }

    public function getTwitter() : string
    {
        return $this->twitter_link;
    }

    public function getGithub() : string
    {
        return $this->github_link;
    }

    public function getBlog() : string
    {
        return $this->blog_link;
    }

    public function getGithubUsername()
    {
        $link = preg_split('#/#', $this->getGithub());

        return $link[3];
    }

    public function setFirstName(string $firstName)
    {
        $this->first_name = $firstName;
    }

    public function setLastName(string $lastName)
    {
        $this->last_name = $lastName;
    }

    public function setPreferredName(string $preferredName)
    {
        $this->preferred_name = $preferredName;
    }

    public function setLocation(string $location)
    {
        $this->location = $location;
    }

    public function setTwitter(string $twitter)
    {
        $this->twitter_link = $twitter;
    }

    public function setGithub(string $github)
    {
        $this->github_link = $github;
    }

    public function setBlog(string $blog)
    {
        $this->blog_link = $blog;
    }

    public function setUserId(int $userId)
    {
        $this->user_id = $userId;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }
}
