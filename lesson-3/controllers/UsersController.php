<?php

class UsersController
{
    public function index()
    {
        $users = User::all();
        return view('users-index', [
            'users' => $users
        ]);
    }
}
