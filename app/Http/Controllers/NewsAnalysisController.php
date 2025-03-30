<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use TextAnalysis\Filters\StopWords;
use TextAnalysis\Tokenizers\GeneralTokenizer;
use App\Models\KeywordsPool;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Client\RequestException;
use Exception;

class NewsAnalysisController extends Controller
{
    private $gnewsApiKey;
    private $serpApiKey;
    private $client;

    public function __construct()
    {
        $this->gnewsApiKey = env('GNEWS_API_KEY');
        $this->serpApiKey = env('SERP_API_KEY');
    }

    //<1. FETCH NEWS
    public function fetchNews()
    {
        try {
            $lastRun = Cache::get('last_news_fetch', now()->subHours(8)->format('Y-m-d\TH:i:s\Z'));
            $currentRun = now()->format('Y-m-d\TH:i:s\Z');

            $response = Http::withOptions(['verify' => false])->retry(1, 3)->connectTimeout(10)->accept('application/json')->get('https://gnews.io/api/v4/top-headlines?',[
                'category' => 'technology',
                'lang' => 'it',
                'from' => $lastRun,
                'to' => $currentRun,
                'max' => 200,
                'apikey' => $this->gnewsApiKey
            ]);

            Cache::put('last_news_fetch', $currentRun, 86400);

            return ApiResponse::success($response->json(), "News recuperate con successo", 200);
        } catch (Exception $e) {
            Log::error("Errore API Gnews: " . $e->getMessage());
            return ApiResponse::error("Errore durante il recupero delle news", 500);
        }
    }

    // 📝 2. ANALISI TESTO
    // public function analyzeNews()
    // {
    //     try {
    //         $newsData = $this->fetchNews()->original;
    //         $allText = '';

    //         foreach ($newsData['articles'] as $article) {
    //             $allText .= ' ' . $article['title'] . ' ' . $article['description'];
    //         }

    //         // Tokenizzazione + Stop Words

    //         $stopWords = new StopWords();
    //         $tokenizer = new GeneralTokenizer();
    //         $tokens = array_filter(
    //             $tokenizer->tokenize($allText),
    //             fn($word) => !$stopWords->isStopWord($word) && strlen($word) > 3
    //         );

    //         return response()->json(array_count_values($tokens)); // Ritorna parole più frequenti

    //     } catch (\Exception $e) {
    //         Log::error("Errore nell'analisi testo: " . $e->getMessage());
    //         return response()->json(['error' => 'Errore nell\'analisi del testo'], 500);
    //     }
    // }

    // // 📊 3. FILTRO PAROLE CHIAVE CON GOOGLE TRENDS
    // public function filterKeywords()
    // {
    //     try {
    //         $keywords = $this->analyzeNews()->original;
    //         $filteredKeywords = Cache::remember("google_trends_keywords", 86400, function () use ($keywords) {
    //             $filtered = [];

    //             foreach (array_keys($keywords) as $keyword) {
    //                 try {
    //                     $response = $this->client->get("https://serpapi.com/search.json?engine=google_trends&q={$keyword}&api_key={$this->serpApiKey}");
    //                     $trendData = json_decode($response->getBody(), true);

    //                     if (isset($trendData['interest_over_time']) && $trendData['interest_over_time'] > 60) {
    //                         $filtered[] = $keyword;
    //                     }
    //                 } catch (\Exception $e) {
    //                     continue;
    //                 }
    //             }

    //             return $filtered;
    //         });

    //         // Salviamo solo parole chiave con buon volume
    //         foreach ($filteredKeywords as $keyword) {
    //             KeywordsPool::updateOrCreate(['keyword' => $keyword], ['score' => 1]);
    //         }

    //         return response()->json(['message' => 'Parole chiave salvate con successo']);
    //     } catch (\Exception $e) {
    //         Log::error("Errore nel filtro parole chiave: " . $e->getMessage());
    //         return response()->json(['error' => 'Errore nel filtro delle parole chiave'], 500);
    //     }
    // }
}
