<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;


use App\Models\Blogs;  // Blogs olarak değiştir
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class IndexBlogToElasticsearch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $blog;

    public function __construct(Blogs $blog)  // Blogs olarak değiştir
    {
        $this->blog = $blog;
    }

    public function handle(): void
    {
        Log::info('IndexBlogToElasticsearch job started', ['id' => $this->blog->id]);

        $this->blog->fresh()->searchable();

        Log::info('IndexBlogToElasticsearch job completed', ['id' => $this->blog->id]);
    }
}
