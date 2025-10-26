<?php

namespace App\Http\Controllers\Challenges;

use App\Challenges\Level3\AdvancedLaravelChallenge;
use App\Http\Controllers\Controller;
use App\Services\FlagService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Level3Controller extends Controller
{
    public function index()
    {
        return view('challenges.level3.index', [
            'title' => 'Level 3: Advanced Laravel & Testing',
            'description' => 'Test your advanced Laravel skills including queues, events, testing, and architecture',
        ]);
    }

    /**
     * Challenge 1: Queue Job
     */
    public function queueChallenge(Request $request)
    {
        $data = $request->input('data', ['test' => 'queue_data']);
        $result = AdvancedLaravelChallenge::brokenQueueJob($data);

        if ($result['flag']) {
            Log::info('Level 3 Queue Challenge Solved', ['data' => $data, 'flag' => $result['flag']]);
            FlagService::logFlagSubmission(11, $result['flag'], true);
        }

        return response()->json([
            'input' => $data,
            'result' => $result,
            'hint' => 'Jobs should be queued asynchronously, not processed immediately!',
        ]);
    }

    /**
     * Challenge 2: Event System
     */
    public function eventChallenge(Request $request)
    {
        $payload = $request->input('payload', ['event' => 'test_data']);
        $result = AdvancedLaravelChallenge::brokenEventSystem($payload);

        if ($result['flag']) {
            Log::info('Level 3 Event Challenge Solved', ['payload' => $payload, 'flag' => $result['flag']]);
            FlagService::logFlagSubmission(12, $result['flag'], true);
        }

        return response()->json([
            'payload' => $payload,
            'result' => $result,
            'hint' => 'Check if the event is properly fired and if listeners are registered correctly',
        ]);
    }

    /**
     * Challenge 3: Collection Manipulation
     */
    public function collectionChallenge(Request $request)
    {
        $data = $request->input('data', [
            ['name' => 'Item 1', 'active' => true, 'score' => 30],
            ['name' => 'Item 2', 'active' => false, 'score' => 50],
            ['name' => 'Item 3', 'active' => true, 'score' => 70],
            ['name' => 'Item 4', 'active' => true, 'score' => 40],
            ['name' => 'Item 5', 'active' => true, 'score' => 60],
        ]);
        $result = AdvancedLaravelChallenge::collectionChallenge($data);

        if ($result['flag']) {
            Log::info('Level 3 Collection Challenge Solved', ['data_count' => count($data), 'flag' => $result['flag']]);
            FlagService::logFlagSubmission(13, $result['flag'], true);
        }

        return response()->json([
            'input_count' => count($data),
            'result' => $result,
            'hint' => 'Need at least 3 active items with average score > 50 after processing',
        ]);
    }

    /**
     * Challenge 4: Service Container
     */
    public function serviceContainerChallenge()
    {
        $result = AdvancedLaravelChallenge::serviceContainerChallenge();

        if ($result['flag']) {
            Log::info('Level 3 Service Container Challenge Solved', ['flag' => $result['flag']]);
            FlagService::logFlagSubmission(14, $result['flag'], true);
        }

        return response()->json([
            'result' => $result,
            'hint' => 'Check if the service is properly registered in Laravel\'s service container',
        ]);
    }

    /**
     * Challenge 5: Testing Challenge
     */
    public function testingChallenge(Request $request)
    {
        $testData = $request->input('test_data', [
            'id' => 123,
            'count' => 42,
            'status' => 'active',
        ]);
        $result = AdvancedLaravelChallenge::testingChallenge($testData);

        if ($result['flag']) {
            Log::info('Level 3 Testing Challenge Solved', ['test_data' => $testData, 'flag' => $result['flag']]);
            FlagService::logFlagSubmission(15, $result['flag'], true);
        }

        return response()->json([
            'test_data' => $testData,
            'result' => $result,
            'hint' => 'All test assertions must pass. Check the data structure carefully!',
        ]);
    }

    /**
     * Challenge 6: Advanced Query Builder
     */
    public function queryBuilderChallenge()
    {
        $result = AdvancedLaravelChallenge::advancedQueryBuilderChallenge();

        if ($result['flag']) {
            Log::info('Level 3 Query Builder Challenge Solved', ['flag' => $result['flag']]);
            FlagService::logFlagSubmission(16, $result['flag'], true);
        }

        return response()->json([
            'result' => $result,
            'hint' => 'Complex query with joins, aggregations, and proper grouping',
        ]);
    }

    /**
     * Challenge 7: Middleware Pipeline
     */
    public function middlewarePipelineChallenge(Request $request)
    {
        $requestData = $request->input('request', [
            'token' => 'valid_token_12345',
            'role' => 'admin',
            'data' => ['test' => 'payload'],
        ]);
        $result = AdvancedLaravelChallenge::middlewarePipelineChallenge($requestData);

        if ($result['flag']) {
            Log::info('Level 3 Middleware Pipeline Challenge Solved', ['flag' => $result['flag']]);
            FlagService::logFlagSubmission(17, $result['flag'], true);
        }

        return response()->json([
            'request' => $requestData,
            'result' => $result,
            'hint' => 'Request must pass through all middleware stages: authentication, authorization, validation, processing',
        ]);
    }

    /**
     * Submit flag for verification
     */
    public function submitFlag(Request $request)
    {
        $flag = $request->input('flag');
        $challengeId = $request->input('challenge_id');

        $isValid = strpos($flag, 'FLAG_3_') !== false;

        FlagService::logFlagSubmission($challengeId, $flag, $isValid);

        // Update progress if flag is valid
        if ($isValid) {
            $progressController = new \App\Http\Controllers\API\ProgressController();
            $progressController->updateProgress($request);
        }

        return response()->json([
            'success' => $isValid,
            'message' => $isValid ? 'Flag is correct!' : 'Flag is incorrect. Keep trying!',
        ]);
    }
}
