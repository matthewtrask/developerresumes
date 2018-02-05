<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function create(Request $request)
    {
        $email = new Email();

        $email->setEmail($request->email);
        $email->save();

        return response("{$request->email} was saved!", 201);
    }
}
