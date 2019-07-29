<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model 
{
    public function users()
    {
        return $this->belongsToMany('App\User')
                    ->as('answers')
                    ->withTimestamps();
    }


    protected $fillable = [
        'number', 'description', 'type', 'options', 'answer', 'timer'
    ];

}
