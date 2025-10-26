<?php

namespace App\Http\Controllers\Challenges;

use App\Challenges\Level1\PHPLogicChallenge;
use App\Http\Controllers\Controller;
use App\Services\FlagService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Level1Controller extends Controller
{
    public function index()
    {
        return view('challenges.level1.index', [
            'title' => 'Level 1: PHP Logic & Debugging',
            'description' => 'Test your PHP debugging skills and logical thinking',
        ]);
    }

    /**
     * Challenge 1: Array Function
     */
    public function arrayChallenge(Request $request)
    {
        $numbers = $request->input('numbers', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
        $result = PHPLogicChallenge::brokenArrayFunction($numbers);

        if (strpos($result, 'FLAG_1_') !== false) {
            Log::info('Level 1 Array Challenge Solved', ['numbers' => $numbers, 'result' => $result]);
            FlagService::logFlagSubmission(1, $result, true);
        }

        return response()->json([
            'numbers' => $numbers,
            'result' => $result,
            'hint' => 'The function should sum even numbers, but it\'s summing odd numbers!',
        ]);
    }

    /**
     * Challenge 2: String Manipulation
     */
    public function stringChallenge(Request $request)
    {
        $input = $request->input('input', 'GNIDOC_1_GALF_3_2_1');
        $result = PHPLogicChallenge::brokenStringManipulation($input);

        if (strpos($result, 'FLAG_1_') !== false) {
            Log::info('Level 1 String Challenge Solved', ['input' => $input, 'result' => $result]);
            FlagService::logFlagSubmission(2, $result, true);
        }

        return response()->json([
            'input' => $input,
            'result' => $result,
            'hint' => 'Check the loop increment - are you getting every character you need?',
        ]);
    }

    /**
     * Challenge 3: Factorial
     */
    public function factorialChallenge(Request $request)
    {
        $n = $request->input('n', 5);
        $userAnswer = $request->input('answer');

        if ($userAnswer !== null) {
            $result = PHPLogicChallenge::verifyFactorial($n, $userAnswer);

            if (strpos($result, 'FLAG_1_') !== false) {
                Log::info('Level 1 Factorial Challenge Solved', ['n' => $n, 'answer' => $userAnswer]);
                FlagService::logFlagSubmission(3, $result, true);
            }

            return response()->json([
                'n' => $n,
                'answer' => $userAnswer,
                'result' => $result,
            ]);
        }

        // Show the broken function
        return response()->json([
            'n' => $n,
            'broken_function' => 'function brokenFactorial($n) { if ($n <= 1) { return 1; } return $n * brokenFactorial($n - 1); }',
            'hint' => 'The function looks correct, but there might be an issue with how it\'s being called or the data type!',
        ]);
    }

    /**
     * Challenge 4: String Decoding
     */
    public function decodeChallenge(Request $request)
    {
        $input = $request->input('input', 'iodj_ghfrgh_iodj');
        $result = PHPLogicChallenge::obfuscatedCodeChallenge($input);

        if (strpos($result, 'FLAG_1_') !== false) {
            Log::info('Level 1 Decode Challenge Solved', ['input' => $input, 'result' => $result]);
            FlagService::logFlagSubmission(4, $result, true);
        }

        return response()->json([
            'input' => $input,
            'result' => $result,
            'hint' => 'This is a Caesar cipher, but it only works for lowercase letters. What about uppercase?',
        ]);
    }

    /**
     * Submit flag for verification
     */
    public function submitFlag(Request $request)
    {
        $flag = $request->input('flag');
        $challengeId = $request->input('challenge_id');

        // In a real implementation, you'd verify against the database
        $isValid = strpos($flag, 'FLAG_1_') !== false;

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
