<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user');
    }

    public function show($id)
    {
        return 'User with ID:' . $id;
    }

    public function getUsernameEmail($username, $email)
    {
        return 'The user name is:' . $username . 'email is:' . $email;
    }
}
