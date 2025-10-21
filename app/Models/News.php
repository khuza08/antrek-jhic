<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class News extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'news';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image'
    ];

    /**
     * Generate slug dari title.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
                'separator' => '-',
                'method' => null,
                'maxLength' => 255,
                'maxLengthKeepWords' => true,
                'slugEngineOptions' => [],
                'reserved' => [],
                'unique' => true,
                'includeTrashed' => false,
            ]
        ];
    }

    /**
     * Relasi ke User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
