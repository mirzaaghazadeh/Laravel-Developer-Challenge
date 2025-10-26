<?php

namespace Tests\Feature;

use App\Models\Challenge;
use App\Services\FlagService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChallengeSystemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_view_challenge_index_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Laravel Developer Challenge');
        $response->assertSee('Navid Mirzaaghazadeh');
    }

    /** @test */
    public function it_can_view_dashboard_page()
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Challenge Dashboard');
        $response->assertSee('PHP Logic', false);
        $response->assertSee('Laravel API', false);
        $response->assertSee('Advanced Laravel');
    }

    /** @test */
    public function it_can_view_level1_page()
    {
        $response = $this->get('/level1');

        $response->assertStatus(200);
        $response->assertSee('PHP Logic & Debugging');
        $response->assertSee('Array Function');
        $response->assertSee('String Manipulation');
        $response->assertSee('Factorial Function');
        $response->assertSee('Caesar Cipher');
    }

    /** @test */
    public function it_can_view_level2_page()
    {
        $response = $this->get('/level2');

        $response->assertStatus(200);
        $response->assertSee('Laravel API & Database');
        $response->assertSee('API Validation');
        $response->assertSee('Database Query');
        $response->assertSee('Cache Implementation');
        $response->assertSee('API Response Structure');
        $response->assertSee('Relationship Query');
        $response->assertSee('Middleware Security');
    }

    /** @test */
    public function it_can_view_level3_page()
    {
        $response = $this->get('/level3');

        $response->assertStatus(200);
        $response->assertSee('Advanced Laravel');
        $response->assertSee('Queue Job');
        $response->assertSee('Event System');
        $response->assertSee('Collection Operations');
        $response->assertSee('Service Container');
        $response->assertSee('Testing');
        $response->assertSee('Query Builder');
        $response->assertSee('Middleware Pipeline');
    }

    /** @test */
    public function it_can_view_progress_page()
    {
        $response = $this->get('/progress');

        $response->assertStatus(200);
        $response->assertSee('Your Progress');
        $response->assertSee('Total Challenges');
        $response->assertSee('Completed');
        $response->assertSee('Remaining');
    }

    /** @test */
    public function it_can_submit_level1_array_challenge()
    {
        $response = $this->post('/level1/array', [
            'numbers' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'numbers',
            'result',
            'hint',
        ]);
    }

    /** @test */
    public function it_can_submit_level1_string_challenge()
    {
        $response = $this->post('/level1/string', [
            'input' => 'GNIDOC_1_GALF_3_2_1',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'input',
            'result',
            'hint',
        ]);
    }

    /** @test */
    public function it_can_submit_level1_factorial_challenge()
    {
        $response = $this->post('/level1/factorial', [
            'n' => 5,
            'answer' => 120,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'n',
            'answer',
            'result',
        ]);
    }

    /** @test */
    public function it_can_submit_level1_decode_challenge()
    {
        $response = $this->post('/level1/decode', [
            'input' => 'iodj_ghfrgh_iodj',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'input',
            'result',
            'hint',
        ]);
    }

    /** @test */
    public function it_can_submit_level2_validation_challenge()
    {
        $response = $this->post('/level2/validation', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'age' => 25,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'input',
            'result' => [
                'success',
                'errors',
                'flag',
            ],
        ]);
    }

    /** @test */
    public function it_can_submit_level2_cache_challenge()
    {
        $response = $this->post('/level2/cache', [
            'key' => 'test_key_'.time(),
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'key',
            'result' => [
                'source',
                'flag',
            ],
        ]);
    }

    /** @test */
    public function it_can_submit_level2_api_response_challenge()
    {
        $response = $this->post('/level2/api-response', [
            'page' => 1,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'input' => [
                'items_count',
                'page',
            ],
            'result' => [
                'data',
                'pagination',
                'flag',
            ],
        ]);
    }

    /** @test */
    public function it_can_submit_level3_queue_challenge()
    {
        $response = $this->post('/level3/queue', [
            'data' => ['test' => 'queue_data'],
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'input',
            'result' => [
                'success',
            ],
            'hint',
        ]);
    }

    /** @test */
    public function it_can_submit_level3_event_challenge()
    {
        $response = $this->post('/level3/event', [
            'payload' => ['event' => 'test_data'],
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'payload',
            'result' => [
                'success',
            ],
            'hint',
        ]);
    }

    /** @test */
    public function it_can_submit_level3_collection_challenge()
    {
        $response = $this->post('/level3/collection', [
            'data' => [
                ['name' => 'Item 1', 'active' => true, 'score' => 30],
                ['name' => 'Item 2', 'active' => false, 'score' => 50],
                ['name' => 'Item 3', 'active' => true, 'score' => 70],
                ['name' => 'Item 4', 'active' => true, 'score' => 40],
                ['name' => 'Item 5', 'active' => true, 'score' => 60],
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'input_count',
            'result' => [
                'success',
            ],
            'hint',
        ]);
    }

    /** @test */
    public function it_can_get_progress_api()
    {
        $response = $this->get('/api/progress');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'completed_challenges',
            'found_flags',
            'level1_completed',
            'level2_completed',
            'level3_completed',
            'total_completed',
            'total_challenges',
        ]);
    }

    /** @test */
    public function it_can_update_progress_api()
    {
        $response = $this->post('/api/progress/update', [
            'challenge_id' => 1,
            'flag' => 'FLAG_1_ARRAY_FIX_'.substr(md5('test'), 0, 8),
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'completed_challenges',
            'found_flags',
            'level1_completed',
            'level2_completed',
            'level3_completed',
            'total_completed',
            'total_challenges',
        ]);
    }

    /** @test */
    public function it_can_reset_progress_api()
    {
        $response = $this->post('/api/progress/reset');

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Progress reset successfully',
        ]);
    }

    /** @test */
    public function it_can_submit_flag_level1()
    {
        $response = $this->post('/level1/submit-flag', [
            'challenge_id' => 1,
            'flag' => 'FLAG_1_ARRAY_FIX_'.substr(md5('test'), 0, 8),
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
        ]);
    }

    /** @test */
    public function it_can_submit_flag_level2()
    {
        $response = $this->post('/level2/submit-flag', [
            'challenge_id' => 5,
            'flag' => 'FLAG_2_VALIDATION_'.substr(md5('test'), 0, 8),
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
        ]);
    }

    /** @test */
    public function it_can_submit_flag_level3()
    {
        $response = $this->post('/level3/submit-flag', [
            'challenge_id' => 11,
            'flag' => 'FLAG_3_QUEUE_'.substr(md5('test'), 0, 8),
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
        ]);
    }

    /** @test */
    public function flag_service_can_encrypt_and_decrypt_flags()
    {
        $originalFlag = 'TEST_FLAG_123456';
        $encrypted = FlagService::encrypt($originalFlag);
        $decrypted = FlagService::decrypt($encrypted);

        $this->assertEquals($originalFlag, $decrypted);
    }

    /** @test */
    public function flag_service_can_generate_unique_flags()
    {
        $flag1 = FlagService::generateFlag(1, 'test');
        $flag2 = FlagService::generateFlag(1, 'test');

        $this->assertNotEquals($flag1, $flag2);
        $this->assertStringStartsWith('FLAG_1_', $flag1);
        $this->assertStringContainsString('_test_', $flag1);
    }

    /** @test */
    public function challenge_model_can_store_and_retrieve_flags()
    {
        $challenge = Challenge::create([
            'title' => 'Test Challenge',
            'description' => 'Test Description',
            'level' => 1,
            'encrypted_flag' => FlagService::encrypt('TEST_FLAG'),
            'hints' => ['hint1', 'hint2'],
            'is_active' => true,
        ]);

        $retrieved = Challenge::find($challenge->id);

        $this->assertEquals($challenge->title, $retrieved->title);
        $this->assertEquals($challenge->level, $retrieved->level);
        $this->assertEquals('TEST_FLAG', $retrieved->flag);
    }

    /** @test */
    public function it_shows_creator_credit_in_footer()
    {
        $response = $this->get('/');

        $response->assertSee('Navid Mirzaaghazadeh');
        $response->assertSee('mirzaaghazadeh');
    }
}
