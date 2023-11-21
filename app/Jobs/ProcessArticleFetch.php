<?php

namespace App\Jobs;

use App\Services\NewsFetchService\Contracts\NewsSourceFetchInterface;
use App\Services\NewsFetchService\Contracts\NewsSourceFetchUrlAdapterInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessArticleFetch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private string $url,private NewsSourceFetchInterface $newsSourceFetch)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /** @var NewsSourceFetchUrlAdapterInterface $fetchAdapter */
        $fetchAdapter = app()->make(NewsSourceFetchUrlAdapterInterface::class);
        $content = $fetchAdapter->fetchFromUrl($this->url);
        $articles = $this->newsSourceFetch->processResponse($content);
        dump($articles);
    }
}
