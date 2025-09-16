<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;

use App\Models\Blogs;
use Elastic\Elasticsearch\Client;

class IndexBlogs extends Command
{
    protected $signature = 'blogs:index';
    protected $description = 'Index all blogs into Elasticsearch';
 
    public function handle(Client $elasticsearch)
    {
       $blogs = Blogs::all();

        foreach ($blogs as $blog) {
            $elasticsearch->index([
                'index' => 'blogs',
                'id'    => $blog->id,
                'body'  => [
                    'title'   => $blog->title,
                    'description' => $blog->description,
                ]
            ]);
        }

        $this->info('All blogs indexed successfully!');
    }
}



 
