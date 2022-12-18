<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RefreshCommand extends Command
{
    protected $signature = 'project:refresh';

    protected $description = 'Refresh current project';

    public function handle(): int
    {
        if (app()->isProduction()) {
            return self::FAILURE;
        }
        $this->info('Deleting storage.');
        Storage::deleteDirectory('public/images');
        $this->info(' OK');
//        Storage::deleteDirectory('images/products');
        $this->call('migrate:fresh', [
            '--seed' => true
        ]);

        $this->call('cache:clear');

        return self::SUCCESS;
    }
}
