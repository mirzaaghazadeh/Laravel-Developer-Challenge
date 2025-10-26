<?php

namespace App\Challenges\Level3;

use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Jobs\ProcessDataJob;
use App\Events\DataProcessedEvent;
use Illuminate\Database\Eloquent\Collection;

class AdvancedLaravelChallenge
{
    /**
     * Challenge 1: Queue job debugging
     * Fix the queue job implementation
     */
    public static function brokenQueueJob(array $data): array
    {
        // Bug: Job is not properly dispatched or handled
        try {
            // This should be dispatched to queue, not processed synchronously
            $job = new ProcessDataJob($data);
            $job->handle(); // Bug: Processing synchronously instead of queuing
            
            return [
                'success' => true,
                'message' => 'Job processed',
                'data' => $data,
                'flag' => 'FLAG_3_QUEUE_' . substr(md5(json_encode($data)), 0, 8)
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'hint' => 'Jobs should be queued, not processed immediately',
                'data' => $data
            ];
        }
    }

    /**
     * Challenge 2: Event system issue
     * Fix the event/listener implementation
     */
    public static function brokenEventSystem(array $payload): array
    {
        // Bug: Event is not properly fired or listened to
        $eventFired = false;
        $listenerExecuted = false;
        
        // Mock listener
        Event::listen(DataProcessedEvent::class, function ($event) use (&$listenerExecuted) {
            $listenerExecuted = true;
        });
        
        // Fire event
        Event::dispatch(new DataProcessedEvent($payload));
        $eventFired = true;
        
        // Check if everything worked correctly
        if ($eventFired && $listenerExecuted) {
            return [
                'success' => true,
                'message' => 'Event system working',
                'result' => [
                    'event_fired' => $eventFired,
                    'listener_executed' => $listenerExecuted
                ],
                'flag' => 'FLAG_3_EVENT_' . substr(md5(json_encode($payload)), 0, 8)
            ];
        }
        
        return [
            'success' => false,
            'error' => 'Event system not working properly',
            'event_fired' => $eventFired,
            'listener_executed' => $listenerExecuted
        ];
    }

    /**
     * Challenge 3: Collection manipulation challenge
     * Advanced collection operations
     */
    public static function collectionChallenge(array $data): array
    {
        $collection = collect($data);
        
        // Bug: Inefficient collection operations
        $result = $collection
            ->filter(function ($item) {
                return $item['active'] ?? false;
            })
            ->map(function ($item) {
                $item['score'] = ($item['score'] ?? 0) * 2;
                return $item;
            })
            ->sortByDesc('score')
            ->take(5)
            ->values();
        
        // Hidden flag in collection analysis
        $totalScore = $result->sum('score');
        $avgScore = $result->avg('score');
        
        $stats = [
            'total_score' => $totalScore,
            'average_score' => $avgScore,
            'count' => $result->count()
        ];
        
        if ($result->count() >= 3 && $avgScore > 50) {
            return [
                'success' => true,
                'result' => [
                    'data' => $result->toArray(),
                    'stats' => $stats
                ],
                'flag' => 'FLAG_3_COLLECTION_' . substr(md5($totalScore), 0, 8)
            ];
        }
        
        return [
            'success' => false,
            'result' => [
                'data' => $result->toArray(),
                'stats' => $stats
            ],
            'hint' => 'Need at least 3 active items with average score > 50'
        ];
    }

    /**
     * Challenge 4: Service container challenge
     * Dependency injection issue
     */
    public static function serviceContainerChallenge(): array
    {
        // Bug: Incorrect service container usage
        try {
            // This should use proper dependency injection
            $service = app()->make(\App\Services\DataProcessingService::class);
            
            if (!$service) {
                throw new \Exception('Service not resolved');
            }
            
            $result = $service->process(['test' => 'data']);
            
            return [
                'success' => true,
                'result' => $result,
                'flag' => 'FLAG_3_CONTAINER_' . substr(md5(get_class($service)), 0, 8)
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'result' => [
                    'error' => $e->getMessage()
                ],
                'hint' => 'Check if the service is properly registered in the container'
            ];
        }
    }

    /**
     * Challenge 5: Testing challenge simulation
     * Write proper test assertions
     */
    public static function testingChallenge(array $testData): array
    {
        // Simulate test scenarios
        $results = [];
        
        // Test 1: Array assertion
        $results['test1'] = [
            'expected' => 'assertArrayHasKey',
            'actual' => array_key_exists('id', $testData),
            'passed' => array_key_exists('id', $testData)
        ];
        
        // Test 2: Type assertion
        $results['test2'] = [
            'expected' => 'assertIsInt',
            'actual' => is_int($testData['count'] ?? null),
            'passed' => is_int($testData['count'] ?? null)
        ];
        
        // Test 3: Value assertion
        $results['test3'] = [
            'expected' => 'assertEquals',
            'actual' => ($testData['status'] ?? '') === 'active',
            'passed' => ($testData['status'] ?? '') === 'active'
        ];
        
        $allPassed = collect($results)->every(fn($test) => $test['passed']);
        
        if ($allPassed) {
            return [
                'success' => true,
                'tests' => $results,
                'flag' => 'FLAG_3_TESTING_' . substr(md5(json_encode($testData)), 0, 8)
            ];
        }
        
        return [
            'success' => false,
            'result' => [
                'tests' => $results
            ],
            'hint' => 'All tests must pass to get the flag'
        ];
    }

    /**
     * Challenge 6: Advanced query builder challenge
     * Complex database operations
     */
    public static function advancedQueryBuilderChallenge(): array
    {
        // Bug: Inefficient complex query
        try {
            $results = DB::table('users')
                ->select([
                    'users.id',
                    'users.name',
                    'users.email',
                    DB::raw('COUNT(posts.id) as posts_count'),
                    DB::raw('AVG(comments.rating) as avg_rating')
                ])
                ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
                ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
                ->groupBy('users.id', 'users.name', 'users.email')
                ->havingRaw('COUNT(posts.id) > 0')
                ->orderByDesc('posts_count')
                ->limit(10)
                ->get();
            
            if ($results->count() > 0) {
                return [
                    'success' => true,
                    'results' => $results,
                    'flag' => 'FLAG_3_QUERY_' . substr(md5($results->count()), 0, 8)
                ];
            }
            
            return [
                'success' => false,
                'result' => [
                    'error' => 'No results found'
                ],
                'hint' => 'Query should return users with posts and their average comment ratings'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'hint' => 'Check the SQL syntax and joins'
            ];
        }
    }

    /**
     * Challenge 7: Middleware pipeline challenge
     * Advanced middleware implementation
     */
    public static function middlewarePipelineChallenge(array $request): array
    {
        // Simulate middleware pipeline
        $pipeline = [
            'authentication' => function($req) {
                return isset($req['token']) ? $req : null;
            },
            'authorization' => function($req) {
                return ($req['role'] ?? 'guest') === 'admin' ? $req : null;
            },
            'validation' => function($req) {
                return isset($req['data']) ? $req : null;
            },
            'sanitization' => function($req) {
                // Sanitize input data
                if (isset($req['data'])) {
                    $req['data'] = array_map('trim', (array)$req['data']);
                }
                return $req;
            },
            'rate_limiting' => function($req) {
                // Simulate rate limiting check
                $req['rate_limited'] = false;
                return $req;
            },
            'logging' => function($req) {
                // Log the request
                $req['logged'] = true;
                return $req;
            },
            'processing' => function($req) {
                $req['processed'] = true;
                $req['timestamp'] = now()->timestamp;
                return $req;
            }
        ];
        
        $result = $request;
        $executed = [];
        
        foreach ($pipeline as $name => $middleware) {
            $result = $middleware($result);
            $executed[] = $name;
            
            if ($result === null) {
                return [
                    'success' => false,
                    'failed_at' => $name,
                    'executed' => $executed,
                    'hint' => "Middleware '{$name}' failed. Check the request format."
                ];
            }
        }
        
        return [
            'success' => true,
            'result' => [
                'data' => $result,
                'executed' => $executed
            ],
            'flag' => 'FLAG_3_MIDDLEWARE_' . substr(md5(implode(',', $executed)), 0, 8)
        ];
    }
}