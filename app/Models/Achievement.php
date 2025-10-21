<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Achievement
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $category_id
 * @property string $title
 * @property string|null $slug
 * @property string|null $description
 * @property string|null $excerpt
 * @property string|null $rank
 * @property string|null $image // <-- Tambahkan ini
 * @property string|null $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category // <-- Tambahkan ini
 * @property-read \App\Models\User|null $user // <-- Tambahkan ini
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereImage($value) 
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereUserId($value)
 */
class Achievement extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'excerpt',
        'rank',
        'image',
        'date'
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

    public function getImageAttribute($value)
    {
        if (!$value) {
            return null;
        }

        try {
            $header = substr($value, 0, 4);
            $mimeType = match ($header) {
                "\xFF\xD8\xFF" => 'image/jpeg',
                "\x89\x50\x4E\x47" => 'image/png',
                default => 'image/jpeg',
            };

            return "data:{$mimeType};base64," . base64_encode($value);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
