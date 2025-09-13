<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // Match the SQL table name used for Q&A pairs
    protected $table = 'qa_pairs';

    public $timestamps = false;

    protected $fillable = [
        'question',
        'answer',
    ];
}
