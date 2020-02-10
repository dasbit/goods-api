<?php


namespace App\Repositories;


use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UsersRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UsersRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return $this->model->query()->whereEmail($email)->first();
    }

    /**
     * @param string $login
     * @return User|null
     */
    public function findByLogin(string $login): ?User
    {
        return $this->model->query()->whereLogin($login)->first();
    }

    /**
     * @param string $login_or_email
     * @return User|null
     */
    public function findByLoginOrEmail(string $login_or_email): ?User
    {
        return $this->model->query()
            ->whereLogin($login_or_email)
            ->orWhere('email', '=', $login_or_email)
            ->first();
    }
}
