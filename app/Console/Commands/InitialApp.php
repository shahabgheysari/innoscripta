<?php

namespace App\Console\Commands;

use App\Services\NewsFetchService\NewsSourceSectionsPersistService;
use Illuminate\Console\Command;

class InitialApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:initial-app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fetching and persisting categories';

    /**
     * Execute the console command.
     */
    public function handle(NewsSourceSectionsPersistService $service)
    {
        $count = $service->fetchAndPersist();
        $this->info('The Number of Sections that Was Imported : '.$count);
    }
}
