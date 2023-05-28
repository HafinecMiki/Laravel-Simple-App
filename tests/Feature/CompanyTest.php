<?php

namespace Tests\Feature;

use Tests\TestCase;

class CompanyTest extends TestCase
{
    /**
     * test_company_create
     *
     * @return void
     */
    public function test_company_create()
    {
        $data = [
            'name'          => $this->faker->name,
            'tax_number'    => $this->faker->text,
            'phone_number'  => $this->faker->phoneNumber,
            'email'         => $this->faker->email
        ];

        $this->actingAs($this->user())->postJson(self::ROUTE . 'company-create', $data)->assertStatus(302);

        $this->assertDatabaseHas('companies', [
            'name'         => $data['name'],
            'tax_number'   => $data['tax_number'],
            'phone_number' => $data['phone_number'],
            'email'        => $data['email']
        ]);
    }

    /**
     * test_company_create_invalid
     *
     * @return void
     */
    public function test_company_create_invalid()
    {
        $data = [
            'name'          => $this->faker->name,
            'tax_number'    => $this->faker->text,
            'phone_number'  => $this->faker->phoneNumber,
            'email'         => 'test@example.com'
        ];

        $response = $this->actingAs($this->user())->postJson(self::ROUTE . 'company-create', $data);

        $this->assertSame(
            'Email is alredy used!',
            $response->getData()->errors->email[0]
        );
    }

    /**
     * test_company_update
     *
     * @return void
     */
    public function test_company_update()
    {
        $data = [
            'name'          => $this->faker->name,
            'tax_number'    => $this->faker->text,
            'phone_number'  => $this->faker->phoneNumber,
            'email'         => $this->faker->email
        ];

        $company = $this->company();

        $this->actingAs($this->user())->putJson(self::ROUTE . 'company/' . $company->id, $data)->assertStatus(302);

        $this->assertDatabaseHas('companies', [
            'id'           => $company->id,
            'name'         => $data['name'],
            'tax_number'   => $data['tax_number'],
            'phone_number' => $data['phone_number'],
            'email'        => $data['email']
        ]);
    }

    /**
     * test_company_update_invalid
     *
     * @return void
     */
    public function test_company_update_invalid()
    {
        $data = [
            'name'          => $this->faker->name,
            'tax_number'    => $this->faker->text,
            'phone_number'  => $this->faker->phoneNumber,
            'email'         => 'test@example.com'
        ];

        $company = $this->company();

        $response = $this->actingAs($this->user())->putJson(self::ROUTE . 'company/' . $company->id, $data)->assertStatus(422);

        $this->assertSame(
            'Email is alredy used!',
            $response->getData()->errors->email[0]
        );
    }

    /**
     * test_company_delete
     *
     * @return void
     */
    public function test_company_delete()
    {
        $company = $this->company();

        $this->actingAs($this->user())->deleteJson(self::ROUTE . 'company/' . $company->id)->assertStatus(302);

        $this->assertDatabaseMissing('companies', ['id' => $company->id]);
    }
}
