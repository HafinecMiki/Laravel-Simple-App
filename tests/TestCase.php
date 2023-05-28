<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\Company;
use App\Models\User;
use App\Models\VerifyCode;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker;

    protected const ROUTE = '/api/v1/';

    protected function setUp(): void
    {
        // Call the original set up
        parent::setUp();
    }

    /**
     * user
     *
     * @return User
     */
    protected function user(): User
    {
        return User::factory()->create();
    }

    /**
     * company
     *
     * @return Company
     */
    protected function company(): Company
    {
        return Company::factory()->create();
    }

    /**
     * findCodeByEmail
     *
     * @return VerifyCode
     */
    protected function findCodeByEmail(String $email): VerifyCode
    {
        $user = User::firstWhere('email', $email);

        return VerifyCode::firstWhere('user_id', $user->id);
    }

    /**
     * findCodeByEmail
     *
     * @return User
     */
    protected function findUserByEmail(String $email): User
    {
        return User::firstWhere('email', $email);
    }
}
