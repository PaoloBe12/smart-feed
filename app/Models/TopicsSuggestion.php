<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\KeywordsPool;
use App\Models\News;


class TopicsSuggestion extends Model
{
    use HasFactory;

    protected $table = 'topics_suggestion';

    protected $fillable = [
        'keyword_id',
        'title',
        'description',
        'source',
        'status'
    ];

    // Relazione con KeywordPool
    public function keyword(): BelongsTo
    {
        return $this->belongsTo(KeywordsPool::class);
    }

    // Relazione con News
    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }
}
