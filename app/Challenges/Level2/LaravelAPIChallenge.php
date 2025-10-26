<?php

namespace App\Challenges\Level2;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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
            'age' => 'numeric|min:18',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'errors' => $validator->errors()->toArray(),
                'flag' => null,
            ];
        }

        // Hidden flag when validation passes correctly
        return [
            'success' => true,
            'message' => 'Validation passed!',
            'errors' => [], // Include empty errors array for consistent structure
            'flag' => null, // No flag until validation is properly fixed
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
                'created_at' => $user->created_at,
            ];
        }

        // Flag hidden in query count analysis
        $queryCount = count(DB::getQueryLog());

        return [
            'users' => $result,
            'query_count' => $queryCount,
            'hint' => $queryCount > 2 ? 'Too many queries! Think about eager loading.' : null,
            'flag' => null, // No flag until optimized
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

        if (! $cachedData) {
            // Simulate expensive operation
            $data = [
                'timestamp' => now()->timestamp,
                'random_data' => Str::random(10),
                'processed_at' => now()->toISOString(),
            ];

            // Bug: No proper cache key namespace and no expiration
            Cache::put($key, $data);

            return [
                'source' => 'database',
                'data' => $data,
                'flag' => null, // No flag until cache is properly implemented
            ];
        }

        return [
            'source' => 'cache',
            'data' => $cachedData,
            'flag' => null,
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

        // Bug: Incorrect pagination logic - should be ($page - 1) * $perPage
        $offset = $page * $perPage;
        $paginatedItems = array_slice($items, $offset, $perPage);

        // Bug: Missing from and to in pagination
        $response = [
            'data' => $paginatedItems,
            'pagination' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => $total,
                'last_page' => $lastPage,
            ],
            'flag' => null, // Will be set if pagination is correct
        ];

        // Hidden flag when pagination is correct (proper offset and has from/to)
        // @phpstan-ignore-next-line - Intentional challenge logic checks for keys that may not exist
        $correctOffset = ($page - 1) * $perPage;
        // @phpstan-ignore-next-line - Intentional challenge logic checks for keys that may not exist
        $hasFromTo = array_key_exists('from', $response['pagination']) && array_key_exists('to', $response['pagination']);

        // @phpstan-ignore-next-line - Intentional challenge logic
        if ($offset === $correctOffset && $hasFromTo && count($paginatedItems) > 0) {
            $response['flag'] = 'FLAG_2_API_'.substr(md5(json_encode($response['pagination'])), 0, 8);
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
            'flag' => null, // No flag until relationship is fixed
            'hint' => 'Can you optimize this query? Check the GROUP BY clause!',
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
        if (! $apiKey || strlen($apiKey) < 10) {
            return [
                'success' => false,
                'error' => 'Invalid API key',
                'flag' => null,
            ];
        }

        // Bug: No timestamp validation for replay attacks
        if (! $timestamp || (time() - $timestamp) > 300) {
            return [
                'success' => false,
                'error' => 'Request expired',
                'flag' => null,
            ];
        }

        // Hidden flag when security is properly implemented
        return [
            'success' => true,
            'message' => 'Authentication successful',
            'data' => $request,
            'flag' => null, // No flag until security is properly implemented
        ];
    }
}
