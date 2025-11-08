<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Blogs extends Model
{
    use HasFactory, Searchable;
    
    public $table = 'blogs';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'title',
        'description',
        'author',
        'image',
    ];

    /**
     * Elasticsearch'te index edilecek veriyi belirler
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'author' => $this->author,
        ];
    }

    /**
     * Elasticsearch index adını özelleştir
     */
    public function searchableAs()
    {
        return 'blogs';
    }

    /**
     * Model'in index edilip edilmeyeceğini belirler
     */
    public function shouldBeSearchable()
    {
        // Tüm blogları index et (title ve description boş değilse)
        return !empty($this->title) && !empty($this->description);
    }

    protected static function booted()
    {
        static::created(function ($blog) {
            event(new \App\Events\BlogUpdatedSearch($blog));
        });

        static::updated(function ($blog) {
            \Log::info('Blog updated event tetiklendi', ['id' => $blog->id]);
            event(new \App\Events\BlogUpdatedSearch($blog));
        });

        static::deleted(function ($blog) {
            $blog->unsearchable(); // Elasticsearch'ten kaldır
        });
    }

}