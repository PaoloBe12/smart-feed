<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\KeywordsPoolController;
use App\Http\Controllers\TopicsSuggestionController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\LogPublicationsController;
use App\Http\Controllers\NewsAnalysisController;

use Illuminate\Support\Facades\Redirect;
use Laravel\Prompts\Key;

Route::prefix('v1')->group(function () {

    Route::get('/fetch-news', [NewsAnalysisController::class, 'fetchNews']);
    Route::get('/analyze-news', [NewsAnalysisController::class, 'analyzeNews']);
    Route::get('/filter-keywords', [NewsAnalysisController::class, 'filterKeywords']);
    Route::get('/get-keywords', [NewsAnalysisController::class, 'getKeywords']);
    

    Route::get('/keywords/today', [KeywordsPoolController::class, 'index']);
    Route::get('/keywords/week', [KeywordsPoolController::class, 'getThisWeekKeywords']);
    Route::get('/keywords/month', [KeywordsPoolController::class, 'getThisMonthKeywords']);
    Route::get('/keywords/all-time', [KeywordsPoolController::class, 'getAllTimeKeywords']);
    Route::apiResource('keywords', KeywordsPoolController::class);

    Route::apiResource('topics', TopicsSuggestionController::class);
    Route::apiResource('news', NewsController::class);
    Route::apiResource('log-publications', LogPublicationsController::class);

    Route::fallback(function () {

        $segment = request()->segment(1);

        return match ($segment) {
            'keywords' => redirect()->route('keywords.index'),
            'topics' => redirect()->route('topics.index'),
            'news' => redirect()->route('news.index'),
            'log-publications' => redirect()->route('log-publications.index'),
            default => response()->json(['message' => 'Endpoint non trovato'], 404)
        };
    });
});
