<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\Auth\LoginSuccess;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class AuthController extends Controller
{
    /**
     * @var UserRepositoryInterface $repository
     */
    protected $repository;

    /**
     * AuthController constructor.
     *
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Login
     *
     * @param Request $request
     * @return LoginSuccess
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'login' => 'required_if:email,null',
            'email' => 'required_if:login,null|email',
            'password' => 'required'
        ]);
        $login_or_email = $request->input('login', $request->input('email'));
        $password = $request->input('password');

        $user = $this->repository->findByLoginOrEmail($login_or_email);
        if ($user === null || ! Hash::check($password, $user->password)){
            throw new AccessDeniedException('Access Denied');
        }

        return new LoginSuccess($user);
    }
}
