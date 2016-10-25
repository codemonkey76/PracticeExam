<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
    'option_text'
    ];

    public function user()
    {
        return $this->belongsTo('App\Question');
    }
}
