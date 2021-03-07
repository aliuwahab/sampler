<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function create(array $newUserData): Model;

    public function find(int $id): ?Model;

    public function all(): Collection;
}
