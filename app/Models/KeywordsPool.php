<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\TopicsSuggestion;

class KeywordsPool extends Model
{
    use HasFactory;

    protected $table = 'keywords_pool';

    protected $fillable = [
        'keyword',
        'seo_score',
        'source',
    ];

    // Relazione con TopicsSuggestion
    public function topicsSuggestions(): HasMany
    {
        return $this->hasMany(TopicsSuggestion::class);
    }
}
