<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Challenge;
use App\Services\FlagService;

class ChallengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Level 1 Challenges
        $this->createLevel1Challenges();
        
        // Level 2 Challenges
        $this->createLevel2Challenges();
        
        // Level 3 Challenges
        $this->createLevel3Challenges();
    }

    private function createLevel1Challenges()
    {
        $level1Challenges = [
            [
                'title' => 'Array Function Fix',
                'description' => 'Fix the broken array function that should sum even numbers. The current logic is summing odd numbers instead.',
                'level' => 1,
                'flag' => 'FLAG_1_ARRAY_FIX_' . substr(md5('array_sum_even'), 0, 8),
                'hints' => [
                    'Check the condition in the if statement',
                    'The modulo operator (%) is used incorrectly',
                    'Even numbers have a remainder of 0 when divided by 2'
                ]
            ],
            [
                'title' => 'String Manipulation',
                'description' => 'Fix the string manipulation to extract the hidden message. The loop increment might be wrong.',
                'level' => 1,
                'flag' => 'FLAG_1_STRING_' . substr(md5('string_reverse_extract'), 0, 8),
                'hints' => [
                    'The input string needs to be reversed first',
                    'Check the loop increment - are you getting every character?',
                    'Try incrementing by 1 instead of 2'
                ]
            ],
            [
                'title' => 'Factorial Function',
                'description' => 'Calculate factorial correctly. The function looks correct but there might be a data type issue.',
                'level' => 1,
                'flag' => 'FLAG_1_FACTORIAL_' . substr(md5('factorial_recursive'), 0, 8),
                'hints' => [
                    'The recursive logic looks correct',
                    'Check the return type - should it be an integer?',
                    'Make sure you\'re comparing integers correctly'
                ]
            ],
            [
                'title' => 'Caesar Cipher Decoder',
                'description' => 'Fix the Caesar cipher decoder. It only works for lowercase letters but input might be mixed case.',
                'level' => 1,
                'flag' => 'FLAG_1_DECODE_' . substr(md5('caesar_cipher_mixed'), 0, 8),
                'hints' => [
                    'The current implementation only handles lowercase letters',
                    'What happens with uppercase letters?',
                    'You need to handle both cases separately'
                ]
            ]
        ];

        foreach ($level1Challenges as $challenge) {
            Challenge::create([
                'title' => $challenge['title'],
                'description' => $challenge['description'],
                'level' => $challenge['level'],
                'encrypted_flag' => FlagService::encrypt($challenge['flag']),
                'hints' => $challenge['hints'],
                'is_active' => true
            ]);
        }
    }

    private function createLevel2Challenges()
    {
        $level2Challenges = [
            [
                'title' => 'API Validation Fix',
                'description' => 'Fix the API validation logic. The validation rules might not be comprehensive enough.',
                'level' => 2,
                'flag' => 'FLAG_2_VALIDATION_' . substr(md5('api_validation_rules'), 0, 8),
                'hints' => [
                    'Check all validation rules are present',
                    'Are there any missing required fields?',
                    'Consider edge cases in email validation'
                ]
            ],
            [
                'title' => 'Database Query Optimization',
                'description' => 'Optimize the database query to avoid N+1 problems. Count the queries being executed.',
                'level' => 2,
                'flag' => 'FLAG_2_DATABASE_' . substr(md5('query_optimization'), 0, 8),
                'hints' => [
                    'Count how many queries are being executed',
                    'Think about eager loading relationships',
                    'Use with() to prevent N+1 queries'
                ]
            ],
            [
                'title' => 'Cache Implementation',
                'description' => 'Fix the caching implementation to avoid key collisions and improve performance.',
                'level' => 2,
                'flag' => 'FLAG_2_CACHE_' . substr(md5('cache_strategy_fix'), 0, 8),
                'hints' => [
                    'Consider cache key naming conventions',
                    'Add proper expiration times',
                    'Use namespaces for cache keys'
                ]
            ],
            [
                'title' => 'API Response Structure',
                'description' => 'Fix the API response pagination structure. Handle edge cases correctly.',
                'level' => 2,
                'flag' => 'FLAG_2_API_' . substr(md5('api_response_structure'), 0, 8),
                'hints' => [
                    'Check pagination logic for edge cases',
                    'Verify data structure consistency',
                    'Handle empty results properly'
                ]
            ],
            [
                'title' => 'Relationship Query Optimization',
                'description' => 'Optimize the Eloquent relationship query. Can you do this with fewer queries?',
                'level' => 2,
                'flag' => 'FLAG_2_RELATIONSHIP_' . substr(md5('relationship_query'), 0, 8),
                'hints' => [
                    'Think about join vs subquery performance',
                    'Consider using proper Eloquent relationships',
                    'Can this be done in a single query?'
                ]
            ],
            [
                'title' => 'Middleware Security',
                'description' => 'Fix the middleware security implementation. What\'s missing in the validation?',
                'level' => 2,
                'flag' => 'FLAG_2_SECURITY_' . substr(md5('middleware_security'), 0, 8),
                'hints' => [
                    'Check API key validation strength',
                    'Consider replay attack prevention',
                    'Add rate limiting or timestamp validation'
                ]
            ]
        ];

        foreach ($level2Challenges as $challenge) {
            Challenge::create([
                'title' => $challenge['title'],
                'description' => $challenge['description'],
                'level' => $challenge['level'],
                'encrypted_flag' => FlagService::encrypt($challenge['flag']),
                'hints' => $challenge['hints'],
                'is_active' => true
            ]);
        }
    }

    private function createLevel3Challenges()
    {
        $level3Challenges = [
            [
                'title' => 'Queue Job Implementation',
                'description' => 'Fix the queue job implementation. Jobs should be processed asynchronously, not immediately.',
                'level' => 3,
                'flag' => 'FLAG_3_QUEUE_' . substr(md5('queue_job_async'), 0, 8),
                'hints' => [
                    'Jobs should be dispatched, not processed immediately',
                    'Use Queue::push() or dispatch() helper',
                    'Check job configuration and queue connection'
                ]
            ],
            [
                'title' => 'Event System Fix',
                'description' => 'Fix the event system to properly fire and listen to events. Check if listeners are registered.',
                'level' => 3,
                'flag' => 'FLAG_3_EVENT_' . substr(md5('event_system_listeners'), 0, 8),
                'hints' => [
                    'Verify event listeners are registered',
                    'Check EventServiceProvider configuration',
                    'Ensure events are properly dispatched'
                ]
            ],
            [
                'title' => 'Collection Operations',
                'description' => 'Advanced collection manipulation with filtering and mapping. Need specific score requirements.',
                'level' => 3,
                'flag' => 'FLAG_3_COLLECTION_' . substr(md5('collection_advanced'), 0, 8),
                'hints' => [
                    'Need at least 3 active items',
                    'Average score must be greater than 50',
                    'Check collection filtering and mapping logic'
                ]
            ],
            [
                'title' => 'Service Container Resolution',
                'description' => 'Test dependency injection and service container resolution. Check service registration.',
                'level' => 3,
                'flag' => 'FLAG_3_CONTAINER_' . substr(md5('service_container_di'), 0, 8),
                'hints' => [
                    'Check if service is registered in container',
                    'Verify service provider configuration',
                    'Check binding and resolution methods'
                ]
            ],
            [
                'title' => 'Testing Assertions',
                'description' => 'Write proper test assertions to validate data structure. All tests must pass.',
                'level' => 3,
                'flag' => 'FLAG_3_TESTING_' . substr(md5('testing_assertions'), 0, 8),
                'hints' => [
                    'Check data structure requirements',
                    'Verify all assertion types are correct',
                    'Ensure test data matches expected format'
                ]
            ],
            [
                'title' => 'Advanced Query Builder',
                'description' => 'Complex database operations with joins and aggregations. Optimize the query structure.',
                'level' => 3,
                'flag' => 'FLAG_3_QUERY_' . substr(md5('advanced_query_builder'), 0, 8),
                'hints' => [
                    'Check join conditions and aliases',
                    'Verify aggregate function usage',
                    'Ensure proper grouping and having clauses'
                ]
            ],
            [
                'title' => 'Middleware Pipeline',
                'description' => 'Advanced middleware implementation with multiple stages. All stages must pass.',
                'level' => 3,
                'flag' => 'FLAG_3_MIDDLEWARE_' . substr(md5('middleware_pipeline'), 0, 8),
                'hints' => [
                    'Request must pass through all middleware stages',
                    'Check authentication requirements',
                    'Verify authorization and validation logic'
                ]
            ]
        ];

        foreach ($level3Challenges as $challenge) {
            Challenge::create([
                'title' => $challenge['title'],
                'description' => $challenge['description'],
                'level' => $challenge['level'],
                'encrypted_flag' => FlagService::encrypt($challenge['flag']),
                'hints' => $challenge['hints'],
                'is_active' => true
            ]);
        }
    }
}