<?php

namespace App\Http\Controllers\Challenges;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index()
    {
        return view('challenges.index', [
            'title' => 'Laravel Developer Challenge',
            'description' => 'Test your Laravel and PHP skills with our 3-level challenge system'
        ]);
    }

    public function dashboard()
    {
        $challenges = Challenge::where('is_active', true)->get()->groupBy('level');
        
        return view('challenges.dashboard', [
            'title' => 'Challenge Dashboard',
            'challenges' => $challenges
        ]);
    }

    public function progress()
    {
        // In a real implementation, this would track user progress
        return view('challenges.progress', [
            'title' => 'Your Progress',
            'total_challenges' => 17,
            'completed_levels' => [
                1 => false,
                2 => false,
                3 => false
            ]
        ]);
    }
}