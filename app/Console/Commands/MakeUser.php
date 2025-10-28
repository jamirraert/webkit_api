<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user';

    /**
     * Execute the console command.
     */
     public function handle()
    {
        $name = $this->ask('Name');
        $email = $this->ask('Email');

        // Check if email already exists
        if (User::where('email', $email)->exists()) {
            $this->error("User with email $email already exists.");
            return 1;
        }

        $password = $this->secret('password');
        $passwordConfirmation = $this->secret('Confirm password');

        if ($password !== $passwordConfirmation) {
            $this->error("Passwords do not match.");
            return 1;
        }

        $isAdmin = $this->confirm('Should this user be an admin?');

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        $this->info("User {$user->name} created successfully" . ($isAdmin ? " as admin" : "") . ".");

        return 0;
    }
}
