<?php

namespace App\Jobs;

use App\Services\NewsFetchService\Model\FetchArticleOutput;
use App\Services\NewsFetchService\PersistArticleService;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessArticle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    /**
     * @param array|FetchArticleOutput[] $articles
     */
    public function __construct(private array $articles)
    {
    }


    /**
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle(): void
    {
        /** @var PersistArticleService $persistArticleService */
        $persistArticleService = app()->make(PersistArticleService::class);
        $persistArticleService->persist($this->articles);
    }
}
