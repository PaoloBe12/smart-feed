<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\KeywordsPool;
use Illuminate\Http\Request;

class KeywordsPoolController extends Controller
{
    /**
     * Retrieves keywords created today.
     */
    public function index()
    {
        $keywords = KeywordsPool::whereDate('created_at', today())
            ->orderBy('seo_score', 'desc')
            ->get();

        if ($keywords->isEmpty()) {
            return ApiResponse::success($keywords, "Nessuna parola chiave trovata per oggi", 200);
        }

        return ApiResponse::success($keywords, "Parole chiave recuperate con successo", 200);
    }

    /**
     * Retrieves keywords created this week.
     */
    public function getThisWeekKeywords()
    {
        $keywords = KeywordsPool::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->orderBy('seo_score', 'desc')
            ->limit(10)
            ->get();

        if ($keywords->isEmpty()) {
            return ApiResponse::success($keywords, "Nessuna parola chiave trovata per oggi", 200);
        }

        return ApiResponse::success($keywords, "Parole chiave recuperate con successo", 200);
    }

    /**
     * Retrieves keywords created this month.
     */
    public function getThisMonthKeywords()
    {
        $keywords = KeywordsPool::whereMonth('created_at', now()->month)
            ->orderBy('seo_score', 'desc')
            ->limit(10)
            ->get();

        if ($keywords->isEmpty()) {
            return ApiResponse::success($keywords, "Nessuna parola chiave trovata per oggi", 200);
        }

        return ApiResponse::success($keywords, "Parole chiave recuperate con successo", 200);
    }

    /**
     * Retrieves all-time keywords.
     */
    public function getAllTimeKeywords()
    {
        $keywords = KeywordsPool::orderBy('seo_score', 'desc')
            ->paginate(10);

        if ($keywords->isEmpty()) {
            return ApiResponse::success($keywords, "Nessuna parola chiave trovata per oggi", 200);
        }

        return ApiResponse::success($keywords, "Parole chiave recuperate con successo", 200);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return KeywordsPool::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KeywordsPool $keywordsPool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KeywordsPool $keywordsPool)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KeywordsPool $keywordsPool)
    {
        //
    }
}
