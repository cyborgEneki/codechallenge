<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable =
    [
        'title', 'status', 'reservor_id'
    ];

    public function authors()
    {
        return $this->belongsToMany('App\Models\Author', 'author_book', 'book_id', 'author_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function reservor()
    {
        return $this->belongsTo('App\Models\User', 'reservor_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'book_loan', 'book_id', 'user_id')
        ->withPivot('date_out', 'date_in', 'due_date');
    }
}
