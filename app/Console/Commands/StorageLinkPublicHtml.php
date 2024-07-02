<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class StorageLinkPublicHtml extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:link-public-html';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a symbolic link from "public_html/storage" to "storage/app/public"';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $target = storage_path('app/public');
        $link = base_path('public_html/storage');

        if (File::exists($link)) {
            $this->error('The "public_html/storage" directory already exists.');
            return Command::FAILURE;
        }

        File::link($target, $link);
        $this->info('The "public_html/storage" directory has been linked.');
        return Command::SUCCESS;
    }
}
