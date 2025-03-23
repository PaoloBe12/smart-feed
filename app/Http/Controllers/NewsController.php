<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $news = News::query()
            ->when($request->trend_id, fn($q) => $q->where('trend_id', $request->trend_id))
            ->when($request->title, fn($q) => $q->where('title', 'LIKE', '%' . $request->title . '%'))
            ->when($request->seo_score, fn($q) => $q->where('seo_score', $request->seo_score))
            ->paginate(10);

        return response()->json($news);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'trend_id' => 'required|numeric',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'full_text' => 'required|string',
                'seo_score' => 'required|string|max:255',
            ]);

            $news = News::create($validated);
            return ApiResponse::success($news, "News creata con successo!", 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ApiResponse::error("Qualcosa è andato storto!", 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::find($id);
        return response()->json($news);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $news = News::findOrFail($id);

        $validated = $request->validate([
            'trend_id' => 'bail|required|integer|max:20',
            'title' => 'bail|required|string|max:255',
            'description' => 'bail|required|string',
            'full_text' => 'bail|required|string',
            'seo_score' => 'bail|required|string|max:255',
        ]);

        $news->update($validated);
        return ApiResponse::success($news, "News modificata con successo!", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);

        $news->delete($news);
        return ApiResponse::success($news, "News eliminata con successo!", 200);
    }
}
