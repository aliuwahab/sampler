<?php
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    protected User $user;

    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->user::all();
    }

    /**
     * @param array $validated
     * @return User
     */
    public function create(array $validated): User
    {
        $user = new User();
        $user->email = $validated['email'];
        $user->name = $validated['name'];
        $user->date_of_birth = $validated['date_of_birth'];
        $user->password = bcrypt($validated['password']);
        $user->save();

        return $user;
    }

    public function find(int $id): User
    {
        return $this->user::find($id);
    }
}
