<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateApiToken extends Command
{
    protected $signature = 'generate:token {email}';
    protected $description = 'Generate an API token for a user';

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error('User not found.');
            return;
        }

        $token = $user->createToken('API Token')->plainTextToken;
        $this->info('API Token: ' . $token);
    }
}
