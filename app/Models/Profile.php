<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $table = 'profiles';

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
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
}

