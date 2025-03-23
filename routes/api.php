<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\TrendController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\AiFeedbackController;
use App\Http\Controllers\CustomInputController;
use App\Http\Controllers\DiscardedIdeaController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\NewsletterLogController;


Route::prefix('v1')->group(function () {
    Route::get('/trends/today', [TrendController::class, 'today']);
    Route::apiResource('trends', TrendController::class)
        ->missing(function (Request $request) {
            return Redirect::route('trends.index');
        });

    Route::apiResource('news', NewsController::class)
        ->missing(function (Request $request) {
            return Redirect::route('news.index');
        });

    Route::get('/contents/active', [TrendController::class, 'active']);
    Route::apiResource('contents', ContentController::class)
        ->missing(function (Request $request) {
            return Redirect::route('contents.index');
        });

    Route::resource('custom-inputs', CustomInputController::class)
        ->only([
            'index',
            'store',
            'destroy'
        ])
        ->missing(function (Request $request) {
            return Redirect::route('custom-inputs.index');
        });

    Route::resource('ai-feedback', AiFeedbackController::class)
        ->only([
            'index',
            'store',
            'destroy'
        ])
        ->missing(function (Request $request) {
            return Redirect::route('ai-feedback.index');
        });

    Route::resource('discarded-ideas', DiscardedIdeaController::class)
        ->only([
            'index',
            'store',
            'destroy'
        ])
        ->missing(function (Request $request) {
            return Redirect::route('discarded-ideas.index');
        });

    Route::resource('newsletter-logs', NewsletterLogController::class)
        ->only([
            'index',
            'show',
        ])
        ->missing(function (Request $request) {
            return Redirect::route('discarded-ideas.index');
        });

    Route::get('/logs', [LogController::class, 'index']);


});


Route::fallback(function () {

    $segment = request()->segment(1);

    return match ($segment) {
        'trends' => redirect()->route('trends.index'),
        'news' => redirect()->route('news.index'),
        'contents' => redirect()->route('contents.index'),
        'custom-inputs' => redirect()->route('custom-inputs.index'),
        'ai-feedback' => redirect()->route('ai-feedback.index'),
        'discarded-ideas' => redirect()->route('discarded-ideas.index'),
        'newsletter-logs' => redirect()->route('newsletter-logs.index'),
        'logs' => redirect()->route('logs.index'),
        default => response()->json(['message' => 'Endpoint non trovato'], 404)
    };
});