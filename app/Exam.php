<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'exam_name'
    ];
    public function questions()
    {
        return $this->hasMany('App\Question');
    }
}
