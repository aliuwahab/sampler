<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatUserRequest;
use App\Http\Traits\RespondsWithHttpStatus;
use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    use RespondsWithHttpStatus;

    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->all();

        return $this->success('Users retrieved successfully', $users);
    }

    public function show(int $userId)
    {
        $user = $this->userRepository->find($userId);

        return $this->success('User Retrieved successfully', $user);
    }

    public function store(CreatUserRequest $creatUserRequest)
    {
        $validated = $creatUserRequest->validated();
        $user = $this->userRepository->create($validated);

        return $this->success('User Created Successfully', $user);
    }


}
