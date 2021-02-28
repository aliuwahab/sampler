<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatUserRequest;
use App\Http\Traits\RespondsWithHttpStatus;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use RespondsWithHttpStatus;


    public function index()
    {
        $users = User::all();

        return $this->success('Users retrieved successfully', $users);
    }

    public function show(User $user)
    {
        return $this->success('User retrived successfully', $user);
    }

    public function store(CreatUserRequest $creatUserRequest)
    {

    }


}
