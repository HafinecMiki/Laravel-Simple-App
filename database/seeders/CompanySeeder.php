<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Company
        Company::factory(5)->create();

        Company::factory()->create([
           'name' => 'Test Company',
           'tax_number' => 'test tax number',
           'phone_number' => 'test phone number',
           'email' => 'test@example.com'
       ]);
    }
}
