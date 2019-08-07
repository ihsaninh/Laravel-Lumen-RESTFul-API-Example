<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model 
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    
    protected $fillable = [
        'number', 'description', 'type', 'options', 'answer', 'timer'
    ];

}
