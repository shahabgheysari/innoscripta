<?php

namespace App\Constants;

enum CacheKeys: string
{
    case ARTICLE_SOURCE_KEY = "article_sources";
    case ARTICLE_CATEGORY_KEY = "article_categories";
}
