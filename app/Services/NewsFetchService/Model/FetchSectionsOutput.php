<?php

namespace App\Services\NewsFetchService\Model;

class FetchSectionsOutput
{
    public function __construct(private string $externalId, private string $title)
    {
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }


}
