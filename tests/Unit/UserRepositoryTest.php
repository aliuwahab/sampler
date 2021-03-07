<?php

namespace Tests\Unit;

use App\Models\User;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Arr;
use Tests\TestCase;


class UserRepositoryTest extends TestCase
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = resolve(UserRepository::class);
    }


    public function test_can_create_a_user()
    {
        $user = User::factory()->make()->toArray();
        $userDetails = Arr::add($user, 'password', 'secret');
        $this->userRepository->create($userDetails);

        $this->assertDatabaseHas('users', ['email' => $user['email']]);
    }

    public function test_can_find_a_user()
    {
        $user = User::factory()->create();
        $foundUser = $this->userRepository->find($user->id);

        $this->assertEquals($user->name, $foundUser->name);
        $this->assertEquals($user->email, $foundUser->email);
    }

    public function test_can_fetch_all_users()
    {
        $users = User::factory()->count(10)->create();

        $this->assertEquals(10, $users->count());
    }
}
