<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProgressController extends Controller
{
    /**
     * Get current progress
     */
    public function getProgress()
    {
        // In a real implementation, this would fetch from database
        // For now, we'll use cache to store progress
        $progress = Cache::get('challenge_progress', [
            'completed_challenges' => [],
            'found_flags' => [],
            'level1_completed' => false,
            'level2_completed' => false,
            'level3_completed' => false,
            'total_completed' => 0,
            'total_challenges' => 17,
            'hints_requested' => 0,
            'hints_per_challenge' => [],
        ]);

        return response()->json($progress);
    }

    /**
     * Track hint request
     */
    public function trackHint(Request $request)
    {
        $challengeId = $request->input('challenge_id');

        $progress = Cache::get('challenge_progress', [
            'completed_challenges' => [],
            'found_flags' => [],
            'level1_completed' => false,
            'level2_completed' => false,
            'level3_completed' => false,
            'total_completed' => 0,
            'total_challenges' => 17,
            'hints_requested' => 0,
            'hints_per_challenge' => [],
        ]);

        // Track hint only if not already tracked for this challenge
        if (!isset($progress['hints_per_challenge'][$challengeId])) {
            $progress['hints_requested'] = ($progress['hints_requested'] ?? 0) + 1;
            $progress['hints_per_challenge'][$challengeId] = true;

            Cache::put('challenge_progress', $progress, 3600); // Store for 1 hour
        }

        return response()->json([
            'success' => true,
            'hints_requested' => $progress['hints_requested'],
            'message' => 'Hint tracked successfully'
        ]);
    }

    /**
     * Update progress when a challenge is completed
     */
    public function updateProgress(Request $request)
    {
        $challengeId = $request->input('challenge_id');
        $flag = $request->input('flag');

        $progress = Cache::get('challenge_progress', [
            'completed_challenges' => [],
            'found_flags' => [],
            'level1_completed' => false,
            'level2_completed' => false,
            'level3_completed' => false,
            'total_completed' => 0,
            'total_challenges' => 17,
            'hints_requested' => 0,
            'hints_per_challenge' => [],
        ]);

        // Add to completed challenges if not already there
        if (! in_array($challengeId, $progress['completed_challenges'])) {
            $progress['completed_challenges'][] = $challengeId;
            $progress['found_flags'][] = $flag;
            $progress['total_completed']++;

            // Update level completion status
            if ($challengeId <= 4) {
                $level1Completed = count(array_filter($progress['completed_challenges'], fn ($id) => $id <= 4)) === 4;
                $progress['level1_completed'] = $level1Completed;
            } elseif ($challengeId <= 10) {
                $level2Completed = count(array_filter($progress['completed_challenges'], fn ($id) => $id > 4 && $id <= 10)) === 6;
                $progress['level2_completed'] = $level2Completed;
            } else {
                $level3Completed = count(array_filter($progress['completed_challenges'], fn ($id) => $id > 10)) === 7;
                $progress['level3_completed'] = $level3Completed;
            }

            Cache::put('challenge_progress', $progress, 3600); // Store for 1 hour
        }

        return response()->json($progress);
    }

    /**
     * Reset progress
     */
    public function resetProgress()
    {
        Cache::forget('challenge_progress');

        return response()->json(['message' => 'Progress reset successfully']);
    }
}
