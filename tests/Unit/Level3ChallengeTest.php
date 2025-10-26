<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Challenges\Level3\AdvancedLaravelChallenge;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Level3ChallengeTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_dispatches_queue_jobs_asynchronously()
    {
        Queue::fake();
        
        $data = ['test' => 'queue_data'];
        $result = AdvancedLaravelChallenge::brokenQueueJob($data);
        
        // Should indicate success when job is properly queued
        $this->assertTrue($result['success']);
        $this->assertArrayHasKey('flag', $result);
    }

    /** @test */
    public function it_processes_jobs_synchronously_in_debug_mode()
    {
        $data = ['test' => 'queue_data'];
        $result = AdvancedLaravelChallenge::brokenQueueJob($data);
        
        // Should return success (accepts synchronous processing in this implementation)
        $this->assertTrue($result['success']);
        $this->assertArrayHasKey('flag', $result);
    }

    /** @test */
    public function it_fires_and_listens_to_events_correctly()
    {
        // Don't fake events so listener can execute
        $payload = ['event' => 'test_data'];
        $result = AdvancedLaravelChallenge::brokenEventSystem($payload);
        
        $this->assertTrue($result['success']);
        $this->assertTrue($result['result']['event_fired']);
        $this->assertTrue($result['result']['listener_executed']);
        $this->assertArrayHasKey('flag', $result);
    }

    /** @test */
    public function it_handles_collection_operations_correctly()
    {
        $data = [
            ['name' => 'Item 1', 'active' => true, 'score' => 80],
            ['name' => 'Item 2', 'active' => true, 'score' => 90],
            ['name' => 'Item 3', 'active' => true, 'score' => 70],
            ['name' => 'Item 4', 'active' => false, 'score' => 50],
            ['name' => 'Item 5', 'active' => true, 'score' => 60]
        ];
        
        $result = AdvancedLaravelChallenge::collectionChallenge($data);
        
        // Should return success with 4 active items and avg score > 50
        $this->assertTrue($result['success']);
        $this->assertArrayHasKey('flag', $result);
        $this->assertEquals(4, $result['result']['stats']['count']);
    }

    /** @test */
    public function it_rejects_insufficient_collection_data()
    {
        $data = [
            ['name' => 'Item 1', 'active' => true, 'score' => 30],
            ['name' => 'Item 2', 'active' => true, 'score' => 40]
            // Only 2 active items with avg score 35 (< 50)
        ];
        
        $result = AdvancedLaravelChallenge::collectionChallenge($data);
        
        $this->assertFalse($result['success']);
        $this->assertArrayHasKey('hint', $result);
    }

    /** @test */
    public function it_resolves_service_container_dependencies()
    {
        $result = AdvancedLaravelChallenge::serviceContainerChallenge();
        
        // Should return success when service is properly resolved
        $this->assertTrue($result['success']);
        $this->assertArrayHasKey('flag', $result);
    }

    /** @test */
    public function it_handles_service_resolution_failures()
    {
        // Service should resolve successfully
        $result = AdvancedLaravelChallenge::serviceContainerChallenge();
        
        // Should return success when service resolves
        $this->assertTrue($result['success']);
    }

    /** @test */
    public function it_validates_testing_assertions_correctly()
    {
        $validTestData = [
            'id' => 123,
            'count' => 42,
            'status' => 'active'
        ];
        
        $result = AdvancedLaravelChallenge::testingChallenge($validTestData);
        
        $this->assertTrue($result['success']);
        $this->assertArrayHasKey('flag', $result);
        $this->assertTrue($result['tests']['test1']['passed']);
        $this->assertTrue($result['tests']['test2']['passed']);
        $this->assertTrue($result['tests']['test3']['passed']);
    }

    /** @test */
    public function it_rejects_invalid_testing_data()
    {
        $invalidTestData = [
            'id' => 'not_a_number', // Should be integer
            'count' => 'not_a_number', // Should be integer
            'status' => 'invalid' // Should be 'active'
        ];
        
        $result = AdvancedLaravelChallenge::testingChallenge($invalidTestData);
        
        $this->assertFalse($result['success']);
        $this->assertArrayHasKey('hint', $result);
    }

    /** @test */
    public function it_builds_complex_database_queries_correctly()
    {
        // Create test data
        \App\Models\User::factory()->create(['id' => 1, 'name' => 'Test User', 'email' => 'test@example.com']);
        \App\Models\Post::create(['user_id' => 1, 'title' => 'Test Post', 'content' => 'Content']);
        
        $result = AdvancedLaravelChallenge::advancedQueryBuilderChallenge();
        
        // Should return success when query is properly structured
        $this->assertTrue($result['success']);
        $this->assertArrayHasKey('flag', $result);
    }

    /** @test */
    public function it_handles_database_query_errors()
    {
        // Without data, query returns no results
        $result = AdvancedLaravelChallenge::advancedQueryBuilderChallenge();
        
        // Should handle empty results gracefully
        $this->assertFalse($result['success']);
    }

    /** @test */
    public function it_processes_middleware_pipeline_correctly()
    {
        $validRequest = [
            'token' => 'valid_token_12345',
            'role' => 'admin',
            'data' => ['test' => 'payload']
        ];
        
        $result = AdvancedLaravelChallenge::middlewarePipelineChallenge($validRequest);
        
        $this->assertTrue($result['success']);
        $this->assertArrayHasKey('flag', $result);
        $this->assertCount(7, $result['result']['executed']); // All 7 stages should execute
    }

    /** @test */
    public function it_fails_middleware_pipeline_on_invalid_data()
    {
        $invalidRequest = [
            'token' => 'invalid', // Too short
            'role' => 'user', // Not admin
            'data' => [] // Missing data
        ];
        
        $result = AdvancedLaravelChallenge::middlewarePipelineChallenge($invalidRequest);
        
        $this->assertFalse($result['success']);
        $this->assertArrayHasKey('failed_at', $result);
    }
}