<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'model_text',
        'option_id'
    ];
    public function question()
    {
        $this->hasOne('App\Question');
    }
}
