<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class FlagService
{
    /**
     * Encrypt a flag
     */
    public static function encrypt(string $flag): string
    {
        return Crypt::encrypt($flag);
    }

    /**
     * Decrypt a flag
     */
    public static function decrypt(string $encryptedFlag): string
    {
        return Crypt::decrypt($encryptedFlag);
    }

    /**
     * Generate a unique flag for a challenge
     */
    public static function generateFlag(int $level, string $challengeName): string
    {
        $timestamp = now()->timestamp;
        $random = mt_rand(1000, 9999);

        return "FLAG_{$level}_{$challengeName}_{$timestamp}_{$random}";
    }

    /**
     * Log flag submission for monitoring
     */
    public static function logFlagSubmission(int $challengeId, string $submittedFlag, bool $isCorrect)
    {
        Log::info('Flag submission', [
            'challenge_id' => $challengeId,
            'submitted_flag' => $submittedFlag,
            'is_correct' => $isCorrect,
            'timestamp' => now()->toISOString(),
        ]);
    }

    /**
     * Obfuscate flag for display in hints
     */
    public static function obfuscateFlag(string $flag): string
    {
        $length = strlen($flag);
        if ($length <= 8) {
            return str_repeat('*', $length);
        }

        // For flags that start with FLAG_, keep the FLAG_ prefix
        if (strpos($flag, 'FLAG_') === 0) {
            $start = 'FLAG_';
            $end = substr($flag, -3);
            $middle = str_repeat('*', $length - strlen($start) - strlen($end));

            return $start.$middle.$end;
        }

        $start = substr($flag, 0, 3);
        $end = substr($flag, -3);
        $middle = str_repeat('*', $length - 6);

        return $start.$middle.$end;
    }
}
