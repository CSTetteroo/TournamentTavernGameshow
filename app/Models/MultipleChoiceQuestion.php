<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultipleChoiceQuestion extends Model
{
    protected $table = 'multiple_choice_questions';
    public $timestamps = false;

    protected $fillable = [
        'question', 'option_a', 'option_b', 'option_c', 'correct',
    ];
}
