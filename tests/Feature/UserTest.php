<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * test_register
     *
     * @return void
     */
    public function test_register()
    {
        $data = [
            'email'    => $this->faker->email,
            'name'     => $this->faker->name,
            'password' => $this->faker->password
        ];

        $this->postJson(self::ROUTE . 'register', $data)->assertStatus(302);

        $this->assertDatabaseHas('users', ['email' => $data['email']]);
    }

    /**
     * test_register_with_invalid_email
     *
     * @return void
     */
    public function test_register_with_invalid_email()
    {
        $data = [
            'email'    => 'test@example.com',
            'name'     => $this->faker->name,
            'password' => $this->faker->password
        ];

        $response = $this->postJson(self::ROUTE . 'register', $data);

        $this->assertSame(
            'Email is alredy used!',
            $response->getData()->errors->email[0]
        );
    }

    /**
     * test_register_with_invalid_password
     *
     * @return void
     */
    public function test_register_with_invalid_password()
    {
        $data = [
            'email'    => $this->faker->email,
            'name'     => $this->faker->name,
            'password' => 'asd'
        ];

        $response = $this->postJson(self::ROUTE . 'register', $data);

        $this->assertSame(
            'The password field must be at least 6 characters.',
            $response->getData()->errors->password[0]
        );
    }

    /**
     * test_login_with_2fa
     *
     * @return void
     */
    public function test_login_with_2fa()
    {
        $data = [
            'email'    => 'test@example.com',
            'password' => 'password'
        ];

        $this->postJson(self::ROUTE . 'login2FA', $data)->assertStatus(302);

        $this->assertDatabaseHas('verify_codes', ['user_id' => $this->findUserByEmail($data['email'])->id]);

        $this->postJson(self::ROUTE . 'verify-code/'. $this->findUserByEmail($data['email'])->id, ['code' => $this->findCodeByEmail($data['email'])->code])->assertStatus(302);

        $this->assertDatabaseMissing('verify_codes', ['user_id' => $this->findUserByEmail($data['email'])->id]);
    }

    /**
     * test_invalid_verify_code
     *
     * @return void
     */
    public function test_invalid_verify_code()
    {
        $data = [
            'code'    => $this->faker->realTextBetween(12),
        ];

        $response = $this->postJson(self::ROUTE . 'verify-code/' . $this->faker->numberBetween(1,10), $data)->assertStatus(302);

        $response->assertSessionHas([
            'error' => 'Invalid code!'
        ]);
    }

     /**
     * test_invalid_user_verify_code
     *
     * @return void
     */
    public function test_invalid_user_verify_code()
    {
        $data = [
            'email'    => 'test@example.com',
            'password' => 'password'
        ];

        $this->postJson(self::ROUTE . 'login2FA', $data)->assertStatus(302);

        $response = $this->postJson(self::ROUTE . 'verify-code/' . 2, ['code' => $this->findCodeByEmail($data['email'])->code])->assertStatus(302);

        $response->assertSessionHas([
            'error' => 'Invalid code!'
        ]);
    }
}
