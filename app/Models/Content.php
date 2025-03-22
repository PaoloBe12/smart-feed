<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id',
        'type',
        'content',
        'status'
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
