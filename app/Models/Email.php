<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'emails';

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail() : string
    {
        return $this->email;
    }
}
