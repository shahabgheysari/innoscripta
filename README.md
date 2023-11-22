# Remote Backend Developer Case Study


# install instructions
run following commands:
1. php artisan migrate
2. php artisan app:initial-app
3. php artisan app:fetch-news ( for test on local server)
  - there is a laravel schedule task that can be used for production server.
  it runs every hour and fetches news.
  **use this cron entry:** `* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1`
4. php artisan php artisan queue:work



# use the following env values for the sake of test:

## API keys
NEWS_SOURCE_NYT_API_KEY=5bD4StZTmIKQnsNDKJmoDJcyh4txSA6b
NEWS_SOURCE_THEGUARDIAN_API_KEY=67bac5a6-6d7b-4165-9b3e-209fad49167b
NEWS_SOURCE_NEWSAPIORG_API_KEY=11030aee1ac1490ca379d95e167c0a9b

## Article fetch endpoints
NEWS_SOURCE_NYT_URL=https://api.nytimes.com/svc/news/v3/content/all/all.json
NEWS_SOURCE_THEGUARDIAN_URL=https://content.guardianapis.com/search
NEWS_SOURCE_NEWSAPIORG_URL=https://newsapi.org/v2/top-headlines

## Fetching sections endpoints
NEWS_SOURCE_NYT_SECTIONS_URL=https://api.nytimes.com/svc/news/v3/content/section-list.json
NEWS_SOURCE_THEGUARDIAN_SECTIONS_URL=https://content.guardianapis.com/sections

# API documentation(OpenAPI Specification)
- [document](APIsSpecification.yaml) use any OpenAPI viewer to see the doc (eg. [swagger](https://swagger.io/tools/swagger-ui/))

# Should be Implemented
- Preventing of saving repetitive articles
- Tests
- Dockerizing

# Selected News Sources
- newsapi.org
- The guardian
- New York Times

# How It works
for every news source each one puts ProcessArticleFetch jobs to fetch the content then the result will be added to queue
to be processed by ProcessArticle job.
