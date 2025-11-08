<?php

namespace App\Listeners;

use App\Events\BlogUpdatedSearch;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Jobs\IndexBlogToElasticsearch;

class SyncBlogToElasticsearch
{

    public function __construct()
    {
        //
    }

    public function handle(BlogUpdatedSearch $event): void
    {

        // Log::info('SyncBlogToElasticsearch handle called', ['id' => $event->blog->id ?? null, 'attributes' => $event->blog->getAttributes() ?? []]);

        // $event->blog->fresh()->searchable();

        // Log::info('Finished searchable for', ['id' => $event->blog->id]);

        // $blog = $event->blog;
        // $blog->searchable();

        Log::info('SyncBlogToElasticsearch listener called', ['id' => $event->blog->id]);

        // Job'ı kuyruğa ekle
        IndexBlogToElasticsearch::dispatch($event->blog);

        Log::info('Job dispatched to queue', ['id' => $event->blog->id]);

    }
}
