<?php

namespace App\Challenges\Level1;

class PHPLogicChallenge
{
    /**
     * Challenge 1: Fix the broken array function
     * The function should return the sum of all even numbers in the array
     * Flag is hidden in the correct output
     */
    public static function brokenArrayFunction(array $numbers): string
    {
        $sum = 0;
        foreach ($numbers as $number) {
            // Fixed: Check for even numbers
            if ($number % 2 === 0) {
                $sum += $number;
            }
        }
        
        // Hidden flag in the output when function works correctly
        if ($sum === array_sum(array_filter($numbers, fn($n) => $n % 2 === 0))) {
            return "Correct! FLAG_1_ARRAY_FIX_" . substr(md5($sum), 0, 8);
        }
        
        return "Incorrect sum: {$sum}. Expected: " . array_sum(array_filter($numbers, fn($n) => $n % 2 === 0));
    }

    /**
     * Challenge 2: Debug the string manipulation
     * Find the hidden message by fixing the string operations
     */
    public static function brokenStringManipulation(string $input): string
    {
        // This should reverse the string and extract every character (fixed from every 3rd)
        $reversed = strrev($input);
        $result = '';
        
        // Fixed: Extract every character
        for ($i = 0; $i < strlen($reversed); $i += 1) {
            $result .= $reversed[$i];
        }
        
        // Check if they found the hidden pattern
        if (strpos($result, 'FLAG_1_STRING') !== false) {
            return "Success! You found: {$result}";
        }
        
        return "Try again. Current result: {$result}";
    }

    /**
     * Challenge 3: Fix the recursive function
     * Calculate factorial correctly to reveal the flag
     */
    public static function brokenFactorial(int $n): string
    {
        // Bug: This will cause infinite recursion for n > 1
        if ($n <= 1) {
            return 1;
        }
        
        return $n * self::brokenFactorial($n - 1);
    }

    /**
     * Verify factorial solution and return flag if correct
     */
    public static function verifyFactorial(int $n, int $userAnswer): string
    {
        $correct = 1;
        for ($i = 2; $i <= $n; $i++) {
            $correct *= $i;
        }
        
        if ($userAnswer === $correct) {
            return "Correct! FLAG_1_FACTORIAL_" . substr(md5($correct), 0, 8);
        }
        
        return "Wrong answer. {$n}! = {$correct}, not {$userAnswer}";
    }

    /**
     * Challenge 4: Decode the obfuscated code
     * Figure out what this code does and fix it
     */
    public static function obfuscatedCodeChallenge(string $input): string
    {
        // This is supposed to be a simple Caesar cipher decoder
        $result = '';
        $shift = 3;
        
        for ($i = 0; $i < strlen($input); $i++) {
            $char = $input[$i];
            
            // Fixed: Handle both lowercase and uppercase
            if (ctype_lower($char)) {
                $result .= chr((ord($char) - ord('a') - $shift + 26) % 26 + ord('a'));
            } elseif (ctype_upper($char)) {
                $result .= chr((ord($char) - ord('A') - $shift + 26) % 26 + ord('a'));
            } else {
                $result .= $char;
            }
        }
        
        // Check if they decoded the secret message (case-insensitive check for FLAG_1_)
        if (stripos($result, 'FLAG_1_') !== false || strpos($result, 'FLAG_1_DECODE') !== false) {
            return "Decoded successfully: {$result}";
        }
        
        return "Keep trying. Current decode: {$result}";
    }
}