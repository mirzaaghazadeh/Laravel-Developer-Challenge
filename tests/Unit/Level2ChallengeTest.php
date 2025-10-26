<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Challenges\Level2\LaravelAPIChallenge;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Level2ChallengeTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_validates_api_data_correctly()
    {
        $validData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'age' => 25
        ];
        
        $result = LaravelAPIChallenge::brokenValidation($validData);
        
        $this->assertTrue($result['success']);
        $this->assertArrayHasKey('flag', $result);
    }

    /** @test */
    public function it_rejects_invalid_api_data()
    {
        $invalidData = [
            'name' => '', // Missing required field
            'email' => 'invalid-email', // Invalid email
            'age' => 15 // Below minimum age
        ];
        
        $result = LaravelAPIChallenge::brokenValidation($invalidData);
        
        $this->assertFalse($result['success']);
        $this->assertArrayHasKey('errors', $result);
    }

    /** @test */
    public function it_optimizes_database_queries()
    {
        // Enable query log
        DB::enableQueryLog();
        
        $result = LaravelAPIChallenge::brokenDatabaseQuery();
        
        $queries = DB::getQueryLog();
        
        // Should return flag when optimized (single query)
        $this->assertArrayHasKey('flag', $result);
        $this->assertLessThanOrEqual(2, count($queries));
    }

    /** @test */
    public function it_implements_cache_strategy()
    {
        $key = 'test_key_' . time();
        
        $result = LaravelAPIChallenge::brokenCacheImplementation($key);
        
        // Should return flag on first call (cache miss)
        $this->assertArrayHasKey('flag', $result);
        $this->assertEquals('database', $result['source']);
    }

    /** @test */
    public function it_returns_cached_data_on_subsequent_calls()
    {
        $key = 'test_key_' . time();
        
        // First call - should cache
        $firstResult = LaravelAPIChallenge::brokenCacheImplementation($key);
        
        // Second call - should return cached data
        $secondResult = LaravelAPIChallenge::brokenCacheImplementation($key);
        
        $this->assertEquals('database', $firstResult['source']);
        $this->assertEquals('cache', $secondResult['source']);
    }

    /** @test */
    public function it_paginates_api_responses_correctly()
    {
        $items = range(1, 50);
        $page = 2;
        
        $result = LaravelAPIChallenge::brokenAPIResponse($items, $page);
        
        $this->assertArrayHasKey('data', $result);
        $this->assertArrayHasKey('pagination', $result);
        $this->assertEquals(10, count($result['data'])); // 10 items per page
        $this->assertEquals(2, $result['pagination']['current_page']);
    }

    /** @test */
    public function it_optimizes_relationship_queries()
    {
        $result = LaravelAPIChallenge::brokenRelationshipQuery();
        
        // Should return flag when optimized (single query)
        $this->assertArrayHasKey('flag', $result);
        $this->assertLessThanOrEqual(1, $result['query_count']);
    }

    /** @test */
    public function it_validates_middleware_security()
    {
        $validRequest = [
            'api_key' => 'valid_api_key_12345',
            'role' => 'admin',
            'timestamp' => time()
        ];
        
        $result = LaravelAPIChallenge::brokenMiddlewareLogic($validRequest);
        
        $this->assertTrue($result['success']);
        $this->assertArrayHasKey('flag', $result);
    }

    /** @test */
    public function it_rejects_invalid_api_keys()
    {
        $invalidRequest = [
            'api_key' => 'short', // Too short
            'role' => 'user', // Not admin
            'timestamp' => time() - 400 // Expired
        ];
        
        $result = LaravelAPIChallenge::brokenMiddlewareLogic($invalidRequest);
        
        $this->assertFalse($result['success']);
        $this->assertArrayHasKey('error', $result);
    }
}