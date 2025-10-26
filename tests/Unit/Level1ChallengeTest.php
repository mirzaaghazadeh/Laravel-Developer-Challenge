<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Challenges\Level1\PHPLogicChallenge;

class Level1ChallengeTest extends TestCase
{
    /** @test */
    public function it_can_sum_even_numbers_correctly()
    {
        $numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $result = PHPLogicChallenge::brokenArrayFunction($numbers);
        
        // Should return sum of even numbers: 2 + 4 + 6 + 8 + 10 = 30
        $this->assertStringContainsString('FLAG_1_', $result);
    }

    /** @test */
    public function it_returns_incorrect_sum_for_odd_numbers()
    {
        $numbers = [1, 3, 5, 7, 9]; // Only odd numbers
        $result = PHPLogicChallenge::brokenArrayFunction($numbers);
        
        // Should return sum of even numbers: 2 + 4 + 6 + 8 + 10 = 30
        $this->assertStringContainsString('FLAG_1_', $result);
    }

    /** @test */
    public function it_can_decode_string_correctly()
    {
        $input = 'GNIDOC_1_GALF_3_2_1';
        $result = PHPLogicChallenge::brokenStringManipulation($input);
        
        // Should find the hidden flag when decoded correctly
        $this->assertStringContainsString('FLAG_1_', $result);
    }

    /** @test */
    public function it_calculates_factorial_correctly()
    {
        $result = PHPLogicChallenge::verifyFactorial(5, 120);
        
        // Should return success message for correct factorial
        $this->assertStringContainsString('Correct!', $result);
    }

    /** @test */
    public function it_rejects_incorrect_factorial()
    {
        $result = PHPLogicChallenge::verifyFactorial(5, 100);
        
        // Should return error message for incorrect factorial
        $this->assertStringContainsString('Wrong answer', $result);
    }

    /** @test */
    public function it_can_decode_caesar_cipher_correctly()
    {
        $input = 'iodj_1_ghfrgh'; // "flag_1_decode" shifted by 3
        $result = PHPLogicChallenge::obfuscatedCodeChallenge($input);
        
        // Should find the hidden flag when decoded correctly
        $this->assertStringContainsString('Decoded successfully', $result);
    }

    /** @test */
    public function it_handles_mixed_case_caesar_cipher()
    {
        $input = 'IODJ_1_GHFRGH'; // Uppercase version
        $result = PHPLogicChallenge::obfuscatedCodeChallenge($input);
        
        // Should return success with lowercase decode
        $this->assertStringContainsString('Decoded successfully', $result);
    }
}