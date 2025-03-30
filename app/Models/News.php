<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\LogPublication;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'topic_id',
        'title',
        'content',
        'status',
        'published_at',
    ];

    // Relazione con TopicsSuggestion
    public function topic(): BelongsTo
    {
        return $this->belongsTo(TopicsSuggestion::class);
    }

    // Relazione con LogPublication
    public function logPublications(): HasMany
    {
        return $this->hasMany(LogPublications::class);
    }
}
