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
            "if (\$number % 2 === 0) {",
            "if (\$number % 2 != 0) {",
            $content
        );
        $this->line('  ✓ Reverted brokenArrayFunction (back to odd numbers bug)');

        // Revert 2: brokenStringManipulation - back to increment by 2
        $content = str_replace(
            "for (\$i = 0; \$i < strlen(\$reversed); \$i += 3) {",
            "for (\$i = 0; \$i < strlen(\$reversed); \$i += 2) {",
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

        // Revert 3: brokenCacheImplementation - remove expiration
        $content = str_replace(
            "// Fixed: Added expiration time\n            Cache::put(\$key, \$data, 3600);",
            "// Bug: No proper cache key namespace and no expiration\n            Cache::put(\$key, \$data);",
            $content
        );
        $this->line('  ✓ Reverted brokenCacheImplementation (removed cache expiration)');

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
        $new = "        // Fixed: Job is now properly dispatched
        try {
            // Dispatch job to queue
            ProcessDataJob::dispatch(\$data);";

        $old = "        // Bug: Job is not properly dispatched or handled
        try {
            // This should be dispatched to queue, not processed synchronously
            \$job = new ProcessDataJob(\$data);
            \$job->handle(); // Bug: Processing synchronously instead of queuing";

        $content = str_replace($new, $old, $content);
        $this->line('  ✓ Reverted brokenQueueJob (back to synchronous processing)');

        File::put($file, $content);
        $this->info('  ✅ Level 3 reverted');
        $this->newLine();
    }
}

