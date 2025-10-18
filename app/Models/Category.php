<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    /**
     * Relasi: satu kategori punya banyak jurusan
     */
    public function majors()
    {
        return $this->hasMany(Major::class);
    }
}
