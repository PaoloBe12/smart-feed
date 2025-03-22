<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiFeedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'feedback'
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}

