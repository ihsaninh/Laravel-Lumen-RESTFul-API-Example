<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $fillable = [
        'content', 'img', 'user_id'
    ];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
