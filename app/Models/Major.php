<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $table = "majors";

    protected $fillable = [
        'name',
        'category_id',
        'description'
    ];

    /**
     * Relasi: jurusan milik satu kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
