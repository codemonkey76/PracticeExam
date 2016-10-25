<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'questionText'
    ];

    public function options()
    {
        return $this->hasMany('App\Option');
    }
    public function owner()
    {
        return $this->belongsTo('App\Exam');
    }
}
