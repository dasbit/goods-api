<?php


namespace App\Repositories;

use App\Models\User; //todo change to interface

interface UserRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByEmail(string $email): ?User;
    public function findByLogin(string $login): ?User;
    public function findByLoginOrEmail(string $login_or_email): ?User;
}
