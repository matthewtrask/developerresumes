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
}
