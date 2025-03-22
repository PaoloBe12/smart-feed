<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscardedIdea extends Model
{
    use HasFactory;

    protected $fillable = [
        'idea',
        'reason',
        'created_at'
    ];

    public $timestamps = false;
}

