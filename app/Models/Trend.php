<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trend extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'query',
        'date',
        'source',
        'popularity'
    ];

    public function news()
    {
        return $this->hasMany(News::class);
    }
}
