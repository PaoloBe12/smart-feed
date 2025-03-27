<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogPublications extends Model
{
    use HasFactory;

    protected $table = 'log_publications';

    protected $fillable = [
        'news_id',
        'published_at',
        'platform',
        'status'
    ];

    // Relazione con News
    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }
}
