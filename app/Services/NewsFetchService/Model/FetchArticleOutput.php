<?php

namespace App\Services\NewsFetchService\Model;

class FetchArticleOutput
{
    /**
     * @param string $title
     * @param string $summary
     * @param string $url
     * @param string $imageUrl
     * @param \DateTimeInterface $publishedAt
     * @param string $source
     * @param string $category
     */
    public function __construct(
        private string $title,
        private string $summary,
        private string $url,
        private string $imageUrl,
        private \DateTimeInterface $publishedAt,
        private string $source,
        private string $category
    )
    {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function getPublishedAt(): \DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

}
