<?php

namespace App\Console\Commands;

use App\Services\NewsFetchService\NewsAggregatorFetchService;
use Illuminate\Console\Command;

class FetchNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It puts messages in queue to fetch news';

    /**
     * Execute the console command.
     */
    public function handle(NewsAggregatorFetchService $fetchService): void
    {
        $this->info('Fetching Just Got Started ...');
        $fetchService->fetch();
        $this->info('Messages Has Been Put In Queue.');
        $this->info('Now Run Queue Work Command To Fetch.');
    }
}
