<?php

namespace App\Jobs;

use App\Services\NewsFetchService\Contracts\NewsSourceFetchInterface;
use App\Services\NewsFetchService\Contracts\NewsSourceFetchUrlAdapterInterface;
use App\Services\NewsFetchService\Contracts\NewsSourceInfoInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;

class ProcessArticleFetch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private string $url, private NewsSourceFetchInterface & NewsSourceInfoInterface $newsSourceFetch)
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
        Bus::batch([
            new ProcessArticle($articles)
        ])->name('Import Articles For ' . $this->newsSourceFetch->getName())->dispatch();
    }
}
