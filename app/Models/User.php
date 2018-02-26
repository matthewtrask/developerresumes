<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile() : HasOne
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function resume(): HasOne
    {
        return $this->hasOne(Resume::class, 'user_id', 'id');
    }

    public function name()
    {
        return $this->preferred_name;
    }

    public function userId() : int
    {
        return $this->id;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getRole()
    {
        return $this->role;
    }
}
