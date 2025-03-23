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
        'description',
        'full_text',
        'seo_score',
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
