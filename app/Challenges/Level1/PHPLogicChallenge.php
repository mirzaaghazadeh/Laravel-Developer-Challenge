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
            // Bug: This should check for even numbers
            if ($number % 2 != 0) {
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
        // This should reverse the string and extract every 3rd character
        $reversed = strrev($input);
        $result = '';
        
        // Bug: Loop condition is incorrect
        for ($i = 0; $i < strlen($reversed); $i += 2) {
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
            
            // Bug: This only works for lowercase, but input might be mixed
            if (ctype_lower($char)) {
                $result .= chr((ord($char) - ord('a') - $shift + 26) % 26 + ord('a'));
            } else {
                $result .= $char;
            }
        }
        
        // Check if they decoded the secret message
        if (strpos($result, 'FLAG_1_DECODE') !== false) {
            return "Decoded successfully: {$result}";
        }
        
        return "Keep trying. Current decode: {$result}";
    }
}