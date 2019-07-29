<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model 
{
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function questions()
    {
        return $this->belongsTo('App\Question');
    }

    protected $fillable = [
        'question_id', 'user_id', 'answer', 'attachment'
    ];

}
