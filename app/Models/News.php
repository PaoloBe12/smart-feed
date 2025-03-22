<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'trend_id',
        'title',
        'url',
        'published_at',
        'source'
    ];

    public function trend()
    {
        return $this->belongsTo(Trend::class);
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
