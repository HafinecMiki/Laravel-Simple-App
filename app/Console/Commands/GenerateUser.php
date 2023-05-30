<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate random user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user =  User::factory()->create();

        echo "Login \n";
        echo 'email: ' . $user->email . "\n";
        echo 'password: password' . "\n";
    }
}
