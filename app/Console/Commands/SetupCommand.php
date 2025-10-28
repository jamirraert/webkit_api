<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initializing application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('migrate:fresh', ['--force' => true]);
        $this->info("Migration fresh completed");
    }
}
