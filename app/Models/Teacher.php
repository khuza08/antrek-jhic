<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = "teachers";
    protected $fillable = [
        'role_id',
        'name',
        'description',
        'image',
        'rate',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
