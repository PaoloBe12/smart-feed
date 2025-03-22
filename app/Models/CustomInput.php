<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomInput extends Model
{
    use HasFactory;

    protected $fillable = [
        'input',
        'created_at'
    ];

    public $timestamps = false;
}

