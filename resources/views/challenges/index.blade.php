@extends('layouts.challenge')

@section('title', 'Laravel Developer Challenge')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-4xl font-bold text-center mb-6 text-blue-600">Laravel Developer Challenge</h1>
        
        <div class="text-center mb-8">
            <p class="text-xl text-gray-700 mb-4">Test your Laravel and PHP skills with our comprehensive 3-level challenge system!</p>
            <p class="text-gray-600">Designed for senior developers - complete all challenges in under 45 minutes.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-green-800 mb-3">Level 1</h3>
                <h4 class="font-medium text-green-700 mb-2">PHP Logic & Debugging</h4>
                <ul class="text-sm text-green-600 space-y-1">
                    <li>• Array manipulation</li>
                    <li>• String processing</li>
                    <li>• Recursive functions</li>
                    <li>• Code debugging</li>
                </ul>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-yellow-800 mb-3">Level 2</h3>
                <h4 class="font-medium text-yellow-700 mb-2">Laravel API & Database</h4>
                <ul class="text-sm text-yellow-600 space-y-1">
                    <li>• API validation</li>
                    <li>• Database optimization</li>
                    <li>• Caching strategies</li>
                    <li>• Security practices</li>
                </ul>
            </div>

            <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-red-800 mb-3">Level 3</h3>
                <h4 class="font-medium text-red-700 mb-2">Advanced Laravel</h4>
                <ul class="text-sm text-red-600 space-y-1">
                    <li>• Queue systems</li>
                    <li>• Event handling</li>
                    <li>• Testing strategies</li>
                    <li>• Architecture patterns</li>
                </ul>
            </div>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-blue-800 mb-3">How to Complete</h3>
            <ol class="list-decimal list-inside text-blue-700 space-y-2">
                <li>Solve each challenge by finding and fixing the bugs</li>
                <li>Flags will be revealed in console outputs, API responses, or web pages</li>
                <li>Submit flags to verify your solutions</li>
                <li>Complete all levels to demonstrate your Laravel expertise</li>
            </ol>
        </div>

        <div class="text-center space-y-4">
            <a href="/dashboard" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                View Challenge Dashboard
            </a>
            
            <div class="flex justify-center space-x-4">
                <a href="/level1" class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                    Start Level 1
                </a>
                <a href="/level2" class="inline-block bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition-colors">
                    Start Level 2
                </a>
                <a href="/level3" class="inline-block bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition-colors">
                    Start Level 3
                </a>
            </div>
        </div>
    </div>
</div>
@endsection