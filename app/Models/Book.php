<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable =
    [
        'title', 'status', 'reservor_id', 'category_id'
    ];

    public function authors()
    {
        return $this->belongsToMany('App\Models\Author');
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
        return $this->belongsToMany('App\Models\User')
        ->withPivot('date_out', 'date_in', 'due_date')
        ->withTimestamps();
    }
}
