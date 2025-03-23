<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Trend;
use Illuminate\Http\Request;

class TrendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $trends = Trend::query()
            ->when($request->name, fn($q) => $q->where('name', 'LIKE', '%' . $request->name . '%'))
            ->when($request->topic, fn($q) => $q->where('topic', 'LIKE', '%' . $request->topic . '%'))
            ->when($request->country, fn($q) => $q->where('country', 'LIKE', '%' . $request->country . '%'))
            ->paginate(10);

        return response()->json($trends);
    }

    /**
     * Display a listing of the resource of today.
     */
    public function today()
    {
        $trends = Trend::whereDate('date', today())
            ->paginate(10);

        return response()->json($trends);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'topic' => 'required|string|max:255',
            'country' => 'required|string|max:10',
            'date' => 'required|date'
        ]);

        $trend = Trend::create($validated);
        return ApiResponse::success($trend, "Trend creato con successo!", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $trend = Trend::find($id);
        return response()->json($trend);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $trend = Trend::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'topic' => 'string|max:255',
            'country' => 'string|max:10',
            'date' => 'date'
        ]);

        $trend->update($validated);

        return ApiResponse::success($trend, "Trend modificato con successo!", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $trend = Trend::findOrFail($id);

        $trend->delete($trend);
        return ApiResponse::success($trend, "Trend eliminato con successo!", 200);
    }
}
