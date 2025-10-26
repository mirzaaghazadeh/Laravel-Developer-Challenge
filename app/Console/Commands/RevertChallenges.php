<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RevertChallenges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'challenges:revert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revert all challenges back to their broken state';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔄 Reverting challenges to broken state...');
        $this->newLine();

        $this->revertLevel1();
        $this->revertLevel2();
        $this->revertLevel3();

        $this->newLine();
        $this->info('✅ All challenges have been reverted to broken state!');
        $this->warn('⚠️  You can now practice fixing them again.');

        return 0;
    }

    /**
     * Revert Level 1 challenges
     */
    protected function revertLevel1()
    {
        $this->comment('📁 Level 1: PHPLogicChallenge');

        $file = app_path('Challenges/Level1/PHPLogicChallenge.php');
        $content = File::get($file);

        // Revert 1: brokenArrayFunction - back to checking odd numbers
        $content = str_replace(
            'if ($number % 2 === 0) {',
            'if ($number % 2 != 0) {',
            $content
        );
        $this->line('  ✓ Reverted brokenArrayFunction (back to odd numbers bug)');

        // Revert 2: brokenStringManipulation - back to increment by 2
        $content = str_replace(
            'for ($i = 0; $i < strlen($reversed); $i += 3) {',
            'for ($i = 0; $i < strlen($reversed); $i += 2) {',
            $content
        );
        $this->line('  ✓ Reverted brokenStringManipulation (back to increment by 2)');

        // Revert 3: brokenFactorial - back to string return type
        $content = str_replace(
            "public static function brokenFactorial(int \$n): int\n    {\n        // Fixed: Returns correct type\n        if (\$n <= 1) {\n            return 1;\n        }",
            "public static function brokenFactorial(int \$n): string\n    {\n        // Bug: This will cause infinite recursion for n > 1\n        if (\$n <= 1) {\n            return 1;\n        }",
            $content
        );
        $this->line('  ✓ Reverted brokenFactorial (back to string return type)');

        // Revert 3b: verifyFactorial - remove flag
        $content = str_replace(
            "        if (\$userAnswer === \$correct) {
            return 'Correct! FLAG_1_FACTORIAL_'.substr(md5(\$correct), 0, 8);
        }",
            "        if (\$userAnswer === \$correct) {
            return 'Correct! But no flag until factorial is fixed properly.';
        }",
            $content
        );
        $this->line('  ✓ Reverted verifyFactorial (removed flag)');

        // Revert 4: obfuscatedCodeChallenge - remove uppercase handling
        $new = "            // Fixed: Handle both uppercase and lowercase
            if (ctype_lower(\$char)) {
                \$result .= chr((ord(\$char) - ord('a') - \$shift + 26) % 26 + ord('a'));
            } elseif (ctype_upper(\$char)) {
                \$result .= chr((ord(\$char) - ord('A') - \$shift + 26) % 26 + ord('A'));
            } else {
                \$result .= \$char;
            }";

        $old = "            // Bug: This only works for lowercase, but input might be mixed
            if (ctype_lower(\$char)) {
                \$result .= chr((ord(\$char) - ord('a') - \$shift + 26) % 26 + ord('a'));
            } else {
                \$result .= \$char;
            }";

        $content = str_replace($new, $old, $content);
        $this->line('  ✓ Reverted obfuscatedCodeChallenge (removed uppercase handling)');

        File::put($file, $content);
        $this->info('  ✅ Level 1 reverted');
        $this->newLine();
    }

    /**
     * Revert Level 2 challenges
     */
    protected function revertLevel2()
    {
        $this->comment('📁 Level 2: LaravelAPIChallenge');

        $file = app_path('Challenges/Level2/LaravelAPIChallenge.php');
        $content = File::get($file);

        // Revert 1: brokenValidation - remove required from age
        $content = str_replace(
            "'age' => 'required|numeric|min:18',",
            "'age' => 'numeric|min:18',",
            $content
        );
        $this->line('  ✓ Reverted brokenValidation (removed age required)');

        // Revert 1b: brokenValidation - make flag conditional on proper validation
        $content = str_replace(
            "        // Hidden flag when validation passes correctly
        return [
            'success' => true,
            'message' => 'Validation passed!',
            'errors' => [], // Include empty errors array for consistent structure
            'flag' => 'FLAG_2_VALIDATION_'.substr(md5(json_encode(\$data)), 0, 8),
        ];",
            "        // Hidden flag when validation passes correctly
        return [
            'success' => true,
            'message' => 'Validation passed!',
            'errors' => [], // Include empty errors array for consistent structure
            'flag' => null, // No flag until validation is properly fixed
        ];",
            $content
        );
        $this->line('  ✓ Reverted brokenValidation (removed flag return)');

        // Revert 2: brokenDatabaseQuery - no flag in broken state
        $content = str_replace(
            "        return [
            'users' => \$result,
            'query_count' => \$queryCount,
            'hint' => \$queryCount > 2 ? 'Too many queries! Think about eager loading.' : null,
            'flag' => \$queryCount <= 2 ? 'FLAG_2_DATABASE_'.substr(md5(\$queryCount), 0, 8) : null,
        ];",
            "        return [
            'users' => \$result,
            'query_count' => \$queryCount,
            'hint' => \$queryCount > 2 ? 'Too many queries! Think about eager loading.' : null,
            'flag' => null, // No flag until optimized
        ];",
            $content
        );
        $this->line('  ✓ Reverted brokenDatabaseQuery (removed flag)');

        // Revert 3: brokenCacheImplementation - remove expiration and flag
        $content = str_replace(
            "// Fixed: Added expiration time\n            Cache::put(\$key, \$data, 3600);",
            "// Bug: No proper cache key namespace and no expiration\n            Cache::put(\$key, \$data);",
            $content
        );
        $content = str_replace(
            "            return [
                'source' => 'database',
                'data' => \$data,
                'flag' => 'FLAG_2_CACHE_'.substr(md5(\$key), 0, 8),
            ];",
            "            return [
                'source' => 'database',
                'data' => \$data,
                'flag' => null, // No flag until cache is properly implemented
            ];",
            $content
        );
        $this->line('  ✓ Reverted brokenCacheImplementation (removed cache expiration and flag)');

        // Revert 4: brokenAPIResponse - back to broken pagination
        $newAPI = "        // Fixed: Correct pagination logic
        \$offset = (\$page - 1) * \$perPage;
        \$paginatedItems = array_slice(\$items, \$offset, \$perPage);

        // Fixed: Added from and to in pagination
        \$from = \$offset + 1;
        \$to = min(\$offset + count(\$paginatedItems), \$total);
        
        \$response = [
            'data' => \$paginatedItems,
            'pagination' => [
                'current_page' => \$page,
                'per_page' => \$perPage,
                'total' => \$total,
                'last_page' => \$lastPage,
                'from' => count(\$paginatedItems) > 0 ? \$from : null,
                'to' => count(\$paginatedItems) > 0 ? \$to : null,
            ],
        ];

        // Hidden flag when pagination is correct (proper offset and has from/to)
        \$correctOffset = (\$page - 1) * \$perPage;
        \$hasFromTo = isset(\$response['pagination']['from']) && isset(\$response['pagination']['to']);
        
        if (\$offset === \$correctOffset && \$hasFromTo && count(\$paginatedItems) > 0) {";

        $oldAPI = "        // Bug: Incorrect pagination logic - should be (\$page - 1) * \$perPage
        \$offset = \$page * \$perPage;
        \$paginatedItems = array_slice(\$items, \$offset, \$perPage);

        // Bug: Missing from and to in pagination
        \$response = [
            'data' => \$paginatedItems,
            'pagination' => [
                'current_page' => \$page,
                'per_page' => \$perPage,
                'total' => \$total,
                'last_page' => \$lastPage,
            ],
        ];

        // Hidden flag when pagination is correct (proper offset and has from/to)
        \$correctOffset = (\$page - 1) * \$perPage;
        \$hasFromTo = isset(\$response['pagination']['from']) && isset(\$response['pagination']['to']);
        
        if (\$offset === \$correctOffset && \$hasFromTo && count(\$paginatedItems) > 0) {";

        $content = str_replace($newAPI, $oldAPI, $content);
        $this->line('  ✓ Reverted brokenAPIResponse (back to broken pagination)');

        // Revert 5: brokenRelationshipQuery - back to original broken version
        $newRelationship = "        // This should be optimized with proper relationships
        \$usersWithPosts = DB::table('users')
            ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.email_verified_at',
                'users.created_at',
                'users.updated_at',
                DB::raw('COUNT(posts.id) as posts_count')
            )
            ->groupBy('users.id', 'users.name', 'users.email', 'users.email_verified_at', 'users.created_at', 'users.updated_at')
            ->get();";

        $oldRelationship = "        // This should be optimized with proper relationships
        \$usersWithPosts = DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->select('users.*', DB::raw('COUNT(posts.id) as posts_count'))
            ->groupBy('users.id')
            ->get();";

        $content = str_replace($newRelationship, $oldRelationship, $content);
        $this->line('  ✓ Reverted brokenRelationshipQuery (back to broken GROUP BY)');

        // Revert 5b: brokenRelationshipQuery - remove flag
        $content = str_replace(
            "        return [
            'users' => \$usersWithPosts,
            'query_count' => count(\$queries),
            'flag' => count(\$queries) === 1 ? 'FLAG_2_RELATIONSHIP_'.substr(md5(count(\$queries)), 0, 8) : null,
            'hint' => count(\$queries) > 1 ? 'Too many queries! Can you do this with one query?' : null,
        ];",
            "        return [
            'users' => \$usersWithPosts,
            'query_count' => count(\$queries),
            'flag' => null, // No flag until relationship is fixed
            'hint' => 'Can you optimize this query? Check the GROUP BY clause!',
        ];",
            $content
        );
        $this->line('  ✓ Reverted brokenRelationshipQuery (removed flag)');

        // Revert 6: brokenMiddlewareLogic - remove flag
        $content = str_replace(
            "        // Hidden flag when security is properly implemented
        return [
            'success' => true,
            'message' => 'Authentication successful',
            'data' => \$request,
            'flag' => 'FLAG_2_SECURITY_'.substr(md5(\$apiKey.\$timestamp), 0, 8),
        ];",
            "        // Hidden flag when security is properly implemented
        return [
            'success' => true,
            'message' => 'Authentication successful',
            'data' => \$request,
            'flag' => null, // No flag until security is properly implemented
        ];",
            $content
        );
        $this->line('  ✓ Reverted brokenMiddlewareLogic (removed flag)');

        File::put($file, $content);
        $this->info('  ✅ Level 2 reverted');
        $this->newLine();
    }

    /**
     * Revert Level 3 challenges
     */
    protected function revertLevel3()
    {
        $this->comment('📁 Level 3: AdvancedLaravelChallenge');

        $file = app_path('Challenges/Level3/AdvancedLaravelChallenge.php');
        $content = File::get($file);

        // Revert 1: brokenQueueJob - back to synchronous processing
        $new = '        // Fixed: Job is now properly dispatched
        try {
            // Dispatch job to queue
            ProcessDataJob::dispatch($data);';

        $old = '        // Bug: Job is not properly dispatched or handled
        try {
            // This should be dispatched to queue, not processed synchronously
            $job = new ProcessDataJob($data);
            $job->handle(); // Bug: Processing synchronously instead of queuing';

        $content = str_replace($new, $old, $content);
        $this->line('  ✓ Reverted brokenQueueJob (back to synchronous processing)');

        // Revert 1b: brokenQueueJob - remove flag
        $content = str_replace(
            "            return [
                'success' => true,
                'message' => 'Job processed',
                'data' => \$data,
                'flag' => 'FLAG_3_QUEUE_'.substr(md5(json_encode(\$data)), 0, 8),
            ];",
            "            return [
                'success' => true,
                'message' => 'Job processed',
                'data' => \$data,
                'flag' => null, // No flag until queue is properly implemented
            ];",
            $content
        );
        $this->line('  ✓ Reverted brokenQueueJob (removed flag)');

        // Revert 2: brokenEventSystem - remove flag
        $content = str_replace(
            "            return [
                'success' => true,
                'message' => 'Event system working',
                'result' => [
                    'event_fired' => \$eventFired,
                    'listener_executed' => \$listenerExecuted,
                ],
                'flag' => 'FLAG_3_EVENT_'.substr(md5(json_encode(\$payload)), 0, 8),
            ];",
            "            return [
                'success' => true,
                'message' => 'Event system working',
                'result' => [
                    'event_fired' => \$eventFired,
                    'listener_executed' => \$listenerExecuted,
                ],
                'flag' => null, // No flag until event system is verified
            ];",
            $content
        );
        $this->line('  ✓ Reverted brokenEventSystem (removed flag)');

        // Revert 3: collectionChallenge - remove flag
        $content = str_replace(
            "            return [
                'success' => true,
                'result' => [
                    'data' => \$result->toArray(),
                    'stats' => \$stats,
                ],
                'flag' => 'FLAG_3_COLLECTION_'.substr(md5(\$totalScore), 0, 8),
            ];",
            "            return [
                'success' => true,
                'result' => [
                    'data' => \$result->toArray(),
                    'stats' => \$stats,
                ],
                'flag' => null, // No flag until collection is properly optimized
            ];",
            $content
        );
        $this->line('  ✓ Reverted collectionChallenge (removed flag)');

        // Revert 4: serviceContainerChallenge - remove flag
        $content = str_replace(
            "            return [
                'success' => true,
                'result' => \$result,
                'flag' => 'FLAG_3_CONTAINER_'.substr(md5(get_class(\$service)), 0, 8),
            ];",
            "            return [
                'success' => true,
                'result' => \$result,
                'flag' => null, // No flag until service container is properly configured
            ];",
            $content
        );
        $this->line('  ✓ Reverted serviceContainerChallenge (removed flag)');

        // Revert 5: testingChallenge - remove flag
        $content = str_replace(
            "            return [
                'success' => true,
                'tests' => \$results,
                'flag' => 'FLAG_3_TESTING_'.substr(md5(json_encode(\$testData)), 0, 8),
            ];",
            "            return [
                'success' => true,
                'tests' => \$results,
                'flag' => null, // No flag until all tests pass
            ];",
            $content
        );
        $this->line('  ✓ Reverted testingChallenge (removed flag)');

        // Revert 6: advancedQueryBuilderChallenge - remove flag
        $content = str_replace(
            "                return [
                    'success' => true,
                    'results' => \$results,
                    'flag' => 'FLAG_3_QUERY_'.substr(md5(\$results->count()), 0, 8),
                ];",
            "                return [
                    'success' => true,
                    'results' => \$results,
                    'flag' => null, // No flag until query is optimized
                ];",
            $content
        );
        $this->line('  ✓ Reverted advancedQueryBuilderChallenge (removed flag)');

        // Revert 7: middlewarePipelineChallenge - remove flag
        $content = str_replace(
            "        return [
            'success' => true,
            'result' => [
                'data' => \$result,
                'executed' => \$executed,
            ],
            'flag' => 'FLAG_3_MIDDLEWARE_'.substr(md5(implode(',', \$executed)), 0, 8),
        ];",
            "        return [
            'success' => true,
            'result' => [
                'data' => \$result,
                'executed' => \$executed,
            ],
            'flag' => null, // No flag until middleware pipeline is complete
        ];",
            $content
        );
        $this->line('  ✓ Reverted middlewarePipelineChallenge (removed flag)');

        File::put($file, $content);
        $this->info('  ✅ Level 3 reverted');
        $this->newLine();
    }
}
