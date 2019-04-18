<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookUser extends Model
{
    protected $table = 'book_user';

    public function user ()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }

    public function book ()
    {
        return $this->belongsTo('App\Models\Book', 'book_id', 'book_id');
    }
}
