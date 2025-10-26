<?php

namespace App\Http\Controllers\Challenges;

use App\Http\Controllers\Controller;
use App\Challenges\Level2\LaravelAPIChallenge;
use App\Services\FlagService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Level2Controller extends Controller
{
    public function index()
    {
        return view('challenges.level2.index', [
            'title' => 'Level 2: Laravel API & Database',
            'description' => 'Test your Laravel framework knowledge, API design, and database optimization skills'
        ]);
    }

    /**
     * Challenge 1: API Validation
     */
    public function validationChallenge(Request $request)
    {
        $data = $request->all();
        $result = LaravelAPIChallenge::brokenValidation($data);
        
        if ($result['flag']) {
            Log::info('Level 2 Validation Challenge Solved', ['data' => $data, 'flag' => $result['flag']]);
            FlagService::logFlagSubmission(5, $result['flag'], true);
        }
        
        return response()->json([
            'input' => $data,
            'result' => $result,
            'hint' => 'Check the validation rules - are they comprehensive enough?'
        ]);
    }

    /**
     * Challenge 2: Database Query Optimization
     */
    public function databaseChallenge()
    {
        DB::enableQueryLog();
        $result = LaravelAPIChallenge::brokenDatabaseQuery();
        $queries = DB::getQueryLog();
        DB::disableQueryLog();
        
        if ($result['flag']) {
            Log::info('Level 2 Database Challenge Solved', ['query_count' => count($queries), 'flag' => $result['flag']]);
            FlagService::logFlagSubmission(6, $result['flag'], true);
        }
        
        return response()->json([
            'result' => $result,
            'query_log' => $queries,
            'hint' => 'Count the queries - are there too many? Think about eager loading!'
        ]);
    }

    /**
     * Challenge 3: Cache Implementation
     */
    public function cacheChallenge(Request $request)
    {
        $key = $request->input('key', 'test_key_' . time());
        $result = LaravelAPIChallenge::brokenCacheImplementation($key);
        
        if ($result['flag']) {
            Log::info('Level 2 Cache Challenge Solved', ['key' => $key, 'flag' => $result['flag']]);
            FlagService::logFlagSubmission(7, $result['flag'], true);
        }
        
        return response()->json([
            'key' => $key,
            'result' => $result,
            'hint' => 'Think about cache key collisions and expiration strategies'
        ]);
    }

    /**
     * Challenge 4: API Response Structure
     */
    public function apiResponseChallenge(Request $request)
    {
        $items = $request->input('items', range(1, 50));
        $page = $request->input('page', 1);
        $result = LaravelAPIChallenge::brokenAPIResponse($items, $page);
        
        if ($result['flag']) {
            Log::info('Level 2 API Response Challenge Solved', ['page' => $page, 'flag' => $result['flag']]);
            FlagService::logFlagSubmission(8, $result['flag'], true);
        }
        
        return response()->json([
            'input' => ['items_count' => count($items), 'page' => $page],
            'result' => $result,
            'hint' => 'Check the pagination logic - is it handling edge cases correctly?'
        ]);
    }

    /**
     * Challenge 5: Relationship Query
     */
    public function relationshipChallenge()
    {
        $result = LaravelAPIChallenge::brokenRelationshipQuery();
        
        if ($result['flag']) {
            Log::info('Level 2 Relationship Challenge Solved', ['query_count' => $result['query_count'], 'flag' => $result['flag']]);
            FlagService::logFlagSubmission(9, $result['flag'], true);
        }
        
        return response()->json([
            'result' => $result,
            'hint' => 'Can you optimize this to use fewer queries? Think about joins vs subqueries'
        ]);
    }

    /**
     * Challenge 6: Middleware Logic
     */
    public function middlewareChallenge(Request $request)
    {
        $data = $request->all();
        $result = LaravelAPIChallenge::brokenMiddlewareLogic($data);
        
        if ($result['flag']) {
            Log::info('Level 2 Middleware Challenge Solved', ['data_keys' => array_keys($data), 'flag' => $result['flag']]);
            FlagService::logFlagSubmission(10, $result['flag'], true);
        }
        
        return response()->json([
            'input' => $data,
            'result' => $result,
            'hint' => 'Think about API security - what\'s missing in the validation?'
        ]);
    }

    /**
     * Submit flag for verification
     */
    public function submitFlag(Request $request)
    {
        $flag = $request->input('flag');
        $challengeId = $request->input('challenge_id');
        
        $isValid = strpos($flag, 'FLAG_2_') !== false;
        
        FlagService::logFlagSubmission($challengeId, $flag, $isValid);
        
        return response()->json([
            'success' => $isValid,
            'message' => $isValid ? 'Flag is correct!' : 'Flag is incorrect. Keep trying!'
        ]);
    }
}