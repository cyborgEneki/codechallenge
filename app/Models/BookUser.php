<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookUser extends Model
{
    protected $fillable = [
        'book_id', 'user_id', 'due_date', 'date_out', 'date_in'
    ];

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
