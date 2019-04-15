<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use SoftDeletes;

    protected $fillable = 
    [
        'name'
    ];

    public function books()
    {
        return $this->belongsToMany('App\Models\Book', 'author_book', 'author_id', 'book_id');
    }
}
