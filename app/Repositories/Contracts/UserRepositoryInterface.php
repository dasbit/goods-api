<?php


namespace App\Repositories\Contracts;

use App\Models\User; //todo change to interface

interface UserRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;

    /**
     * @param string $login
     * @return User|null
     */
    public function findByLogin(string $login): ?User;

    /**
     * @param string $login_or_email
     * @return User|null
     */
    public function findByLoginOrEmail(string $login_or_email): ?User;
}
