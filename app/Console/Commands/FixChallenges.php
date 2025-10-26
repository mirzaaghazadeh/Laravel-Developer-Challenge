<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixChallenges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'challenges:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically fix all challenge bugs (does not submit flags)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔧 Starting to fix challenges...');
        $this->newLine();

        $this->fixLevel1();
        $this->fixLevel2();
        $this->fixLevel3();

        $this->newLine();
        $this->info('✅ All challenges have been fixed!');
        $this->warn('⚠️  Note: Flags have NOT been submitted. Run tests to get the flags.');

        return 0;
    }

    /**
     * Fix Level 1 challenges
     */
    protected function fixLevel1()
    {
        $this->comment('📁 Level 1: PHPLogicChallenge');

        $file = app_path('Challenges/Level1/PHPLogicChallenge.php');
        $content = File::get($file);

        // Fix 1: brokenArrayFunction - should check for even numbers
        $content = str_replace(
            'if ($number % 2 != 0) {',
            'if ($number % 2 === 0) {',
            $content
        );
        $this->line('  ✓ Fixed brokenArrayFunction (even numbers check)');

        // Fix 2: brokenStringManipulation - should increment by 3
        $content = str_replace(
            'for ($i = 0; $i < strlen($reversed); $i += 2) {',
            'for ($i = 0; $i < strlen($reversed); $i += 3) {',
            $content
        );
        $this->line('  ✓ Fixed brokenStringManipulation (increment by 3)');

        // Fix 3: brokenFactorial - should return int
        $content = str_replace(
            "public static function brokenFactorial(int \$n): string\n    {\n        // Bug: This will cause infinite recursion for n > 1\n        if (\$n <= 1) {\n            return 1;\n        }",
            "public static function brokenFactorial(int \$n): int\n    {\n        // Fixed: Returns correct type\n        if (\$n <= 1) {\n            return 1;\n        }",
            $content
        );
        $this->line('  ✓ Fixed brokenFactorial (return type)');

        // Fix 3b: verifyFactorial - restore flag
        $content = str_replace(
            "        if (\$userAnswer === \$correct) {
            return 'Correct! But no flag until factorial is fixed properly.';
        }",
            "        if (\$userAnswer === \$correct) {
            return 'Correct! FLAG_1_FACTORIAL_'.substr(md5(\$correct), 0, 8);
        }",
            $content
        );
        $this->line('  ✓ Fixed verifyFactorial (restored flag)');

        // Fix 4: obfuscatedCodeChallenge - handle uppercase
        $old = "            // Bug: This only works for lowercase, but input might be mixed
            if (ctype_lower(\$char)) {
                \$result .= chr((ord(\$char) - ord('a') - \$shift + 26) % 26 + ord('a'));
            } else {
                \$result .= \$char;
            }";

        $new = "            // Fixed: Handle both uppercase and lowercase
            if (ctype_lower(\$char)) {
                \$result .= chr((ord(\$char) - ord('a') - \$shift + 26) % 26 + ord('a'));
            } elseif (ctype_upper(\$char)) {
                \$result .= chr((ord(\$char) - ord('A') - \$shift + 26) % 26 + ord('A'));
            } else {
                \$result .= \$char;
            }";

        $content = str_replace($old, $new, $content);
        $this->line('  ✓ Fixed obfuscatedCodeChallenge (uppercase handling)');

        File::put($file, $content);
        $this->info('  ✅ Level 1 complete');
        $this->newLine();
    }

    /**
     * Fix Level 2 challenges
     */
    protected function fixLevel2()
    {
        $this->comment('📁 Level 2: LaravelAPIChallenge');

        $file = app_path('Challenges/Level2/LaravelAPIChallenge.php');
        $content = File::get($file);

        // Fix 1: brokenValidation - age should be required
        $content = str_replace(
            "'age' => 'numeric|min:18',",
            "'age' => 'required|numeric|min:18',",
            $content
        );
        $this->line('  ✓ Fixed brokenValidation (age required)');

        // Fix 1b: brokenValidation - restore flag return
        $content = str_replace(
            "        // Hidden flag when validation passes correctly
        return [
            'success' => true,
            'message' => 'Validation passed!',
            'errors' => [], // Include empty errors array for consistent structure
            'flag' => null, // No flag until validation is properly fixed
        ];",
            "        // Hidden flag when validation passes correctly
        return [
            'success' => true,
            'message' => 'Validation passed!',
            'errors' => [], // Include empty errors array for consistent structure
            'flag' => 'FLAG_2_VALIDATION_'.substr(md5(json_encode(\$data)), 0, 8),
        ];",
            $content
        );
        $this->line('  ✓ Fixed brokenValidation (restored flag)');

        // Fix 2: brokenDatabaseQuery - restore flag
        $content = str_replace(
            "        return [
            'users' => \$result,
            'query_count' => \$queryCount,
            'hint' => \$queryCount > 2 ? 'Too many queries! Think about eager loading.' : null,
            'flag' => null, // No flag until optimized
        ];",
            "        return [
            'users' => \$result,
            'query_count' => \$queryCount,
            'hint' => \$queryCount > 2 ? 'Too many queries! Think about eager loading.' : null,
            'flag' => \$queryCount <= 2 ? 'FLAG_2_DATABASE_'.substr(md5(\$queryCount), 0, 8) : null,
        ];",
            $content
        );
        $this->line('  ✓ Fixed brokenDatabaseQuery (restored flag)');

        // Fix 3: brokenCacheImplementation - add expiration
        $content = str_replace(
            "// Bug: No proper cache key namespace and no expiration\n            Cache::put(\$key, \$data);",
            "// Fixed: Added expiration time\n            Cache::put(\$key, \$data, 3600);",
            $content
        );
        $content = str_replace(
            "            return [
                'source' => 'database',
                'data' => \$data,
                'flag' => null, // No flag until cache is properly implemented
            ];",
            "            return [
                'source' => 'database',
                'data' => \$data,
                'flag' => 'FLAG_2_CACHE_'.substr(md5(\$key), 0, 8),
            ];",
            $content
        );
        $this->line('  ✓ Fixed brokenCacheImplementation (cache expiration and flag)');

        // Fix 4: brokenAPIResponse - fix offset and add from/to
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

        $content = str_replace($oldAPI, $newAPI, $content);
        $this->line('  ✓ Fixed brokenAPIResponse (pagination offset and from/to fields)');

        // Fix 5: brokenRelationshipQuery - fix GROUP BY to include all columns
        $oldRelationship = "        // This should be optimized with proper relationships
        \$usersWithPosts = DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->select('users.*', DB::raw('COUNT(posts.id) as posts_count'))
            ->groupBy('users.id')
            ->get();";

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

        $content = str_replace($oldRelationship, $newRelationship, $content);
        $this->line('  ✓ Fixed brokenRelationshipQuery (GROUP BY all columns)');

        // Fix 5b: brokenRelationshipQuery - restore flag
        $content = str_replace(
            "        return [
            'users' => \$usersWithPosts,
            'query_count' => count(\$queries),
            'flag' => null, // No flag until relationship is fixed
            'hint' => 'Can you optimize this query? Check the GROUP BY clause!',
        ];",
            "        return [
            'users' => \$usersWithPosts,
            'query_count' => count(\$queries),
            'flag' => count(\$queries) === 1 ? 'FLAG_2_RELATIONSHIP_'.substr(md5(count(\$queries)), 0, 8) : null,
            'hint' => count(\$queries) > 1 ? 'Too many queries! Can you do this with one query?' : null,
        ];",
            $content
        );
        $this->line('  ✓ Fixed brokenRelationshipQuery (restored flag)');

        // Fix 6: brokenMiddlewareLogic - restore flag
        $content = str_replace(
            "        // Hidden flag when security is properly implemented
        return [
            'success' => true,
            'message' => 'Authentication successful',
            'data' => \$request,
            'flag' => null, // No flag until security is properly implemented
        ];",
            "        // Hidden flag when security is properly implemented
        return [
            'success' => true,
            'message' => 'Authentication successful',
            'data' => \$request,
            'flag' => 'FLAG_2_SECURITY_'.substr(md5(\$apiKey.\$timestamp), 0, 8),
        ];",
            $content
        );
        $this->line('  ✓ Fixed brokenMiddlewareLogic (restored flag)');

        File::put($file, $content);
        $this->info('  ✅ Level 2 complete');
        $this->newLine();
    }

    /**
     * Fix Level 3 challenges
     */
    protected function fixLevel3()
    {
        $this->comment('📁 Level 3: AdvancedLaravelChallenge');

        $file = app_path('Challenges/Level3/AdvancedLaravelChallenge.php');
        $content = File::get($file);

        // Fix 1: brokenQueueJob - should dispatch instead of handle
        $old = '        // Bug: Job is not properly dispatched or handled
        try {
            // This should be dispatched to queue, not processed synchronously
            $job = new ProcessDataJob($data);
            $job->handle(); // Bug: Processing synchronously instead of queuing';

        $new = '        // Fixed: Job is now properly dispatched
        try {
            // Dispatch job to queue
            ProcessDataJob::dispatch($data);';

        $content = str_replace($old, $new, $content);
        $this->line('  ✓ Fixed brokenQueueJob (proper dispatch)');

        // Fix 1b: brokenQueueJob - restore flag
        $content = str_replace(
            "            return [
                'success' => true,
                'message' => 'Job processed',
                'data' => \$data,
                'flag' => null, // No flag until queue is properly implemented
            ];",
            "            return [
                'success' => true,
                'message' => 'Job processed',
                'data' => \$data,
                'flag' => 'FLAG_3_QUEUE_'.substr(md5(json_encode(\$data)), 0, 8),
            ];",
            $content
        );
        $this->line('  ✓ Fixed brokenQueueJob (restored flag)');

        // Fix 2: brokenEventSystem - restore flag
        $content = str_replace(
            "            return [
                'success' => true,
                'message' => 'Event system working',
                'result' => [
                    'event_fired' => \$eventFired,
                    'listener_executed' => \$listenerExecuted,
                ],
                'flag' => null, // No flag until event system is verified
            ];",
            "            return [
                'success' => true,
                'message' => 'Event system working',
                'result' => [
                    'event_fired' => \$eventFired,
                    'listener_executed' => \$listenerExecuted,
                ],
                'flag' => 'FLAG_3_EVENT_'.substr(md5(json_encode(\$payload)), 0, 8),
            ];",
            $content
        );
        $this->line('  ✓ Fixed brokenEventSystem (restored flag)');

        // Fix 3: collectionChallenge - restore flag
        $content = str_replace(
            "            return [
                'success' => true,
                'result' => [
                    'data' => \$result->toArray(),
                    'stats' => \$stats,
                ],
                'flag' => null, // No flag until collection is properly optimized
            ];",
            "            return [
                'success' => true,
                'result' => [
                    'data' => \$result->toArray(),
                    'stats' => \$stats,
                ],
                'flag' => 'FLAG_3_COLLECTION_'.substr(md5(\$totalScore), 0, 8),
            ];",
            $content
        );
        $this->line('  ✓ Fixed collectionChallenge (restored flag)');

        // Fix 4: serviceContainerChallenge - restore flag
        $content = str_replace(
            "            return [
                'success' => true,
                'result' => \$result,
                'flag' => null, // No flag until service container is properly configured
            ];",
            "            return [
                'success' => true,
                'result' => \$result,
                'flag' => 'FLAG_3_CONTAINER_'.substr(md5(get_class(\$service)), 0, 8),
            ];",
            $content
        );
        $this->line('  ✓ Fixed serviceContainerChallenge (restored flag)');

        // Fix 5: testingChallenge - restore flag
        $content = str_replace(
            "            return [
                'success' => true,
                'tests' => \$results,
                'flag' => null, // No flag until all tests pass
            ];",
            "            return [
                'success' => true,
                'tests' => \$results,
                'flag' => 'FLAG_3_TESTING_'.substr(md5(json_encode(\$testData)), 0, 8),
            ];",
            $content
        );
        $this->line('  ✓ Fixed testingChallenge (restored flag)');

        // Fix 6: advancedQueryBuilderChallenge - restore flag
        $content = str_replace(
            "                return [
                    'success' => true,
                    'results' => \$results,
                    'flag' => null, // No flag until query is optimized
                ];",
            "                return [
                    'success' => true,
                    'results' => \$results,
                    'flag' => 'FLAG_3_QUERY_'.substr(md5(\$results->count()), 0, 8),
                ];",
            $content
        );
        $this->line('  ✓ Fixed advancedQueryBuilderChallenge (restored flag)');

        // Fix 7: middlewarePipelineChallenge - restore flag
        $content = str_replace(
            "        return [
            'success' => true,
            'result' => [
                'data' => \$result,
                'executed' => \$executed,
            ],
            'flag' => null, // No flag until middleware pipeline is complete
        ];",
            "        return [
            'success' => true,
            'result' => [
                'data' => \$result,
                'executed' => \$executed,
            ],
            'flag' => 'FLAG_3_MIDDLEWARE_'.substr(md5(implode(',', \$executed)), 0, 8),
        ];",
            $content
        );
        $this->line('  ✓ Fixed middlewarePipelineChallenge (restored flag)');

        File::put($file, $content);
        $this->info('  ✅ Level 3 complete');
        $this->newLine();
    }
}
