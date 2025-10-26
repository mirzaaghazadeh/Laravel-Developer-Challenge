<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ProgressUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that submitting a valid Level 1 flag updates progress
     *
     * @test
     */
    public function it_updates_progress_when_valid_level1_flag_is_submitted()
    {
        // Clear any existing progress
        Cache::forget('challenge_progress');

        // Submit a valid flag for challenge 1
        $response = $this->postJson('/level1/submit-flag', [
            'challenge_id' => 1,
            'flag' => 'FLAG_1_ARRAY_FIX_12345678',
        ]);

        // Assert flag was accepted
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Flag is correct!',
            ]);

        // Get progress and verify it was updated
        $progressResponse = $this->getJson('/api/progress');
        $progressResponse->assertStatus(200);

        $progress = $progressResponse->json();

        // Assert challenge 1 is in completed challenges
        $this->assertContains(1, $progress['completed_challenges']);

        // Assert flag is in found flags
        $this->assertContains('FLAG_1_ARRAY_FIX_12345678', $progress['found_flags']);

        // Assert total completed is 1
        $this->assertEquals(1, $progress['total_completed']);
    }

    /**
     * Test that submitting a valid Level 2 flag updates progress
     *
     * @test
     */
    public function it_updates_progress_when_valid_level2_flag_is_submitted()
    {
        // Clear any existing progress
        Cache::forget('challenge_progress');

        // Submit a valid flag for challenge 5 (Level 2)
        $response = $this->postJson('/level2/submit-flag', [
            'challenge_id' => 5,
            'flag' => 'FLAG_2_VALIDATION_PASS',
        ]);

        // Assert flag was accepted
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Flag is correct!',
            ]);

        // Get progress and verify it was updated
        $progressResponse = $this->getJson('/api/progress');
        $progressResponse->assertStatus(200);

        $progress = $progressResponse->json();

        // Assert challenge 5 is in completed challenges
        $this->assertContains(5, $progress['completed_challenges']);

        // Assert total completed is 1
        $this->assertEquals(1, $progress['total_completed']);
    }

    /**
     * Test that submitting a valid Level 3 flag updates progress
     *
     * @test
     */
    public function it_updates_progress_when_valid_level3_flag_is_submitted()
    {
        // Clear any existing progress
        Cache::forget('challenge_progress');

        // Submit a valid flag for challenge 11 (Level 3)
        $response = $this->postJson('/level3/submit-flag', [
            'challenge_id' => 11,
            'flag' => 'FLAG_3_QUEUE_SUCCESS',
        ]);

        // Assert flag was accepted
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Flag is correct!',
            ]);

        // Get progress and verify it was updated
        $progressResponse = $this->getJson('/api/progress');
        $progressResponse->assertStatus(200);

        $progress = $progressResponse->json();

        // Assert challenge 11 is in completed challenges
        $this->assertContains(11, $progress['completed_challenges']);

        // Assert total completed is 1
        $this->assertEquals(1, $progress['total_completed']);
    }

    /**
     * Test that submitting an invalid flag does NOT update progress
     *
     * @test
     */
    public function it_does_not_update_progress_when_invalid_flag_is_submitted()
    {
        // Clear any existing progress
        Cache::forget('challenge_progress');

        // Submit an invalid flag
        $response = $this->postJson('/level1/submit-flag', [
            'challenge_id' => 1,
            'flag' => 'INVALID_FLAG',
        ]);

        // Assert flag was rejected
        $response->assertStatus(200)
            ->assertJson([
                'success' => false,
                'message' => 'Flag is incorrect. Keep trying!',
            ]);

        // Get progress and verify it was NOT updated
        $progressResponse = $this->getJson('/api/progress');
        $progressResponse->assertStatus(200);

        $progress = $progressResponse->json();

        // Assert no challenges are completed
        $this->assertEmpty($progress['completed_challenges']);
        $this->assertEquals(0, $progress['total_completed']);
    }

    /**
     * Test that completing all 4 Level 1 challenges marks level as completed
     *
     * @test
     */
    public function it_marks_level1_as_completed_when_all_4_challenges_are_done()
    {
        // Clear any existing progress
        Cache::forget('challenge_progress');

        // Submit flags for all 4 Level 1 challenges
        for ($i = 1; $i <= 4; $i++) {
            $this->postJson('/level1/submit-flag', [
                'challenge_id' => $i,
                'flag' => "FLAG_1_CHALLENGE_{$i}",
            ]);
        }

        // Get progress and verify Level 1 is marked as completed
        $progressResponse = $this->getJson('/api/progress');
        $progress = $progressResponse->json();

        $this->assertTrue($progress['level1_completed']);
        $this->assertEquals(4, $progress['total_completed']);
    }
}

