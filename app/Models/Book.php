<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'quantity',
        'reference',
        'sinopsis',
        'author_id',
        'category_id',
    ];

    protected $appends = [
        'available',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getAvailableAttribute()
    {
        return fake()->boolean(90);
    }
}
