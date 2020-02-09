<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Login success
     *
     * @return void
     */
    public function testLoginSuccess() : void
    {
        $password = 'secret';
        $user = factory(\App\Models\User::class)->create([
            'password' => app('hash')->make($password)
        ]);
        $content = $this->json('POST', '/auth/login', [
            'login' => $user->login,
            'password' => $password
        ])->seeJson([
            'token' => $user->api_token,
        ]);
    }

    /**
     * Login success
     *
     * @return void
     */
    public function testLoginEmailSuccess() : void
    {
        $password = 'secret';
        $user = factory(\App\Models\User::class)->create([
            'password' => app('hash')->make($password)
        ]);
        $content = $this->json('POST', '/auth/login', [
            'email' => $user->email,
            'password' => $password
        ])->seeJson([
            'token' => $user->api_token
        ]);
    }

    /**
     *
     */
    public function testLoginValidationError() : void
    {
        $validationErrorData = [
            'email' => rand(0, 1) ? 'fake@email.com' : 'fakeemail',
            'login' => 'fakelogin',
        ];

        $this->json('POST', '/auth/login', $validationErrorData)
            ->assertResponseStatus(422);
    }

    /**
     *
     */
    public function testLoginBadCredentials() : void
    {
        $badCreds = [
            'email' => 'fake@email.com',
            'password' => 'fakepassword'
        ];

        $this->json('POST', '/auth/login', $badCreds)
            ->assertResponseStatus(403);
    }
}
