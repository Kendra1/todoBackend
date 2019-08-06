<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    public $timestamps = false;


    protected $fillable = [
        'title', 'description', 'priority', 'completed', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
