<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Models\KeywordsPool;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

use TextAnalysis\Tokenizers\GeneralTokenizer;
use TextAnalysis\Analysis\FreqDist;
use TextAnalysis\Documents\TokensDocument;

use TextAnalysis\Filters\StopWordsFilter;
use TextAnalysis\Filters\LowerCaseFilter;
use TextAnalysis\Filters\CharFilter;
use TextAnalysis\Filters\PunctuationFilter;
use TextAnalysis\Filters\QuotesFilter;

use Exception;

class NewsAnalysisController extends Controller
{
    private $gnewsApiKey;
    private $APITubeKey;
    private $serpApiKey;
    private $client;

    public function __construct()
    {
        $this->gnewsApiKey = env('GNEWS_API_KEY');
        $this->APITubeKey = env('API_TUBE_KEY');
        $this->serpApiKey = env('SERP_API_KEY');
    }

    //1 -> FETCH NEWS
    public function fetchNews()
    {
        try {
            $lastRun = Cache::get('last_news_fetch', now()->subHours(48)->format('Y-m-d\TH:i:s\Z'));
            $currentRun = now()->format('Y-m-d');

            // $response = Http::withOptions(['verify' => false])->retry(1, 3)->connectTimeout(10)->accept('application/json')->get('https://gnews.io/api/v4/top-headlines?',[
            //     'category' => 'technology',
            //     'lang' => 'it',
            //     'country' => 'it',
            //     'from' => $lastRun,
            //     'to' => $currentRun,
            //     'max' => 50,
            //     'apikey' => $this->gnewsApiKey
            // ]);

            $response = Http::withOptions(['verify' => false])->retry(1, 3)->connectTimeout(10)->accept('application/json')->get('https://api.apitube.io/v1/news/top-headlines',[
                'category.id' => 'IAB19', // Tecnologia
                'language' => 'it', // Solo articoli in italiano
                'source.country.code' => 'it', // Notizie da fonti italiane
                'is_duplicate' => 'true', // Evita duplicati
                'sort_by' => 'published_at', // Ordina per data di pubblicazione
                'sort_order' => 'desc',
                'api_key' => $this->APITubeKey
            ]);

            // Cache::put('last_news_fetch', $currentRun, 86400);

            return ApiResponse::success($response->json(), "News recuperate con successo", 200);
        } catch (Exception $e) {
            Log::error("Errore API Gnews: " . $e->getMessage());
            return ApiResponse::error("Errore durante il recupero delle news", 500);
        }
    }

    // 2 -> ANALISI TESTO
    public function analyzeNews()
    {
        try {
            $stopWordsDir = base_path('vendor/yooper/stop-words/data');
            $stopWords = array_map('trim', file($stopWordsDir. '/stop-words_italian_2_it.txt'));

            $newsData = $this->fetchNews()->original;
            $articles = $newsData['data']['articles'] ?? [];

            $allText = implode(' ', array_map(fn($article) => $article['title'] . ' ' . $article['description'], $articles));
        
            $tokenizer = new GeneralTokenizer();
            $tokens = $tokenizer->tokenize($allText);
            
            $tokenDoc = new TokensDocument($tokens);
            $tokenDoc->applyTransformation(new LowerCaseFilter())
            ->applyTransformation(new QuotesFilter())
            ->applyTransformation(new CharFilter());

            $tokensTransformation = $tokenDoc->getDocumentData();
            $filteredTokens = array_filter($tokensTransformation, fn($word) => !in_array(strtolower($word), $stopWords) && mb_strlen($word) > 3);    
            
            $freqDist = new FreqDist($filteredTokens);
            dd(array_slice($freqDist->getKeyValuesByFrequency(), 0, 10), true);
            $top10 = array_splice($freqDist->getKeyValuesByFrequency(), 0, 10);

            return ApiResponse::success($top10, "Testo analizzato con successo", 200);
        
        } catch (\Exception $e) {
            Log::error("Errore nell'analisi testo: {$e->getMessage()} in {$e->getFile()} alla riga {$e->getLine()}");
            return ApiResponse::error("Errore nell'analisi del testo", 500);
        }
    }

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
