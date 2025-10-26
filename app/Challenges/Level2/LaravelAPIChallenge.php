<?php

namespace App\Challenges\Level2;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LaravelAPIChallenge
{
    /**
     * Challenge 1: Fix the API validation
     * User needs to identify what's wrong with this validation and fix it
     */
    public static function brokenValidation(array $data): array
    {
        // Bug: Missing proper validation rules
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'age' => 'numeric|min:18'
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'errors' => $validator->errors()->toArray(),
                'flag' => null
            ];
        }

        // Hidden flag when validation passes correctly
        return [
            'success' => true,
            'message' => 'Validation passed!',
            'errors' => [], // Include empty errors array for consistent structure
            'flag' => 'FLAG_2_VALIDATION_' . substr(md5(json_encode($data)), 0, 8)
        ];
    }

    /**
     * Challenge 2: Database query optimization
     * Find the performance issue in this query
     */
    public static function brokenDatabaseQuery(): array
    {
        // Bug: N+1 query problem
        $users = User::all();
        $result = [];
        
        foreach ($users as $user) {
            // This causes N+1 queries - should use eager loading
            $result[] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at
            ];
        }

        // Flag hidden in query count analysis
        $queryCount = count(DB::getQueryLog());
        
        return [
            'users' => $result,
            'query_count' => $queryCount,
            'hint' => $queryCount > 2 ? 'Too many queries! Think about eager loading.' : null,
            'flag' => $queryCount <= 2 ? 'FLAG_2_DATABASE_' . substr(md5($queryCount), 0, 8) : null
        ];
    }

    /**
     * Challenge 3: Cache implementation issue
     * Fix the caching strategy
     */
    public static function brokenCacheImplementation(string $key): array
    {
        // Bug: Cache key collision and no proper expiration
        $cachedData = Cache::get($key);
        
        if (!$cachedData) {
            // Simulate expensive operation
            $data = [
                'timestamp' => now()->timestamp,
                'random_data' => Str::random(10),
                'processed_at' => now()->toISOString()
            ];
            
            // Bug: No proper cache key namespace and no expiration
            Cache::put($key, $data);
            
            return [
                'source' => 'database',
                'data' => $data,
                'flag' => 'FLAG_2_CACHE_' . substr(md5($key), 0, 8)
            ];
        }
        
        return [
            'source' => 'cache',
            'data' => $cachedData,
            'flag' => null
        ];
    }

    /**
     * Challenge 4: API response structure issue
     * Fix the API response format
     */
    public static function brokenAPIResponse(array $items, int $page = 1): array
    {
        $perPage = 10;
        $total = count($items);
        $lastPage = ceil($total / $perPage);
        
        // Bug: Incorrect pagination logic
        $offset = ($page - 1) * $perPage;
        $paginatedItems = array_slice($items, $offset, $perPage);
        
        // Bug: Missing proper API response structure
        $response = [
            'data' => $paginatedItems,
            'pagination' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => $total,
                'last_page' => $lastPage
            ]
        ];
        
        // Hidden flag when pagination is correct
        if (count($paginatedItems) <= $perPage && $page <= $lastPage) {
            $response['flag'] = 'FLAG_2_API_' . substr(md5(json_encode($response['pagination'])), 0, 8);
        }
        
        return $response;
    }

    /**
     * Challenge 5: Relationship query issue
     * Fix the Eloquent relationship query
     */
    public static function brokenRelationshipQuery(): array
    {
        // Bug: Inefficient relationship loading
        DB::enableQueryLog();
        
        // This should be optimized with proper relationships
        $usersWithPosts = DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->select('users.*', DB::raw('COUNT(posts.id) as posts_count'))
            ->groupBy('users.id')
            ->get();
        
        $queries = DB::getQueryLog();
        DB::disableQueryLog();
        
        return [
            'users' => $usersWithPosts,
            'query_count' => count($queries),
            'flag' => count($queries) === 1 ? 'FLAG_2_RELATIONSHIP_' . substr(md5(count($queries)), 0, 8) : null,
            'hint' => count($queries) > 1 ? 'Too many queries! Can you do this with one query?' : null
        ];
    }

    /**
     * Challenge 6: Middleware issue simulation
     * Identify what's wrong with this middleware logic
     */
    public static function brokenMiddlewareLogic(array $request): array
    {
        // Simulate middleware that should check API key
        $apiKey = $request['api_key'] ?? null;
        $timestamp = $request['timestamp'] ?? null;
        
        // Bug: Weak API key validation
        if (!$apiKey || strlen($apiKey) < 10) {
            return [
                'success' => false,
                'error' => 'Invalid API key',
                'flag' => null
            ];
        }
        
        // Bug: No timestamp validation for replay attacks
        if (!$timestamp || (time() - $timestamp) > 300) {
            return [
                'success' => false,
                'error' => 'Request expired',
                'flag' => null
            ];
        }
        
        // Hidden flag when security is properly implemented
        return [
            'success' => true,
            'message' => 'Authentication successful',
            'data' => $request,
            'flag' => 'FLAG_2_SECURITY_' . substr(md5($apiKey . $timestamp), 0, 8)
        ];
    }
}