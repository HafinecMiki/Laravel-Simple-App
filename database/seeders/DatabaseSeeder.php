<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User
         User::factory(5)->create();

         $user = User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
         ]);

         // Company
         Company::factory(5)->create();

         echo "Login \n";
         echo 'email: ' . $user->email . "\n";
         echo 'password: password' . "\n";
    }
}
