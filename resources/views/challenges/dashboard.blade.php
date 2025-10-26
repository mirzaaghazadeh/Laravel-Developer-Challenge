@extends('layouts.challenge')

@section('title', $title)

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-center mb-8 text-blue-600">{{ $title }}</h1>

        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <!-- Level 1 Progress -->
            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-green-800 mb-4">Level 1</h3>
                <h4 class="font-medium text-green-700 mb-3">PHP Logic & Debugging</h4>
                
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-sm">Array Function</span>
                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">4 challenges</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm">String Manipulation</span>
                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">4 challenges</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm">Factorial Function</span>
                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">4 challenges</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm">Caesar Cipher</span>
                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">4 challenges</span>
                    </div>
                </div>
                
                <div class="mt-4">
                    <div class="flex justify-between text-sm mb-1">
                        <span>Progress</span>
                        <span>0/4</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                </div>
                
                <a href="/level1" class="mt-4 block w-full bg-green-600 text-white px-4 py-2 rounded text-center hover:bg-green-700">
                    Start Level 1
                </a>
            </div>

            <!-- Level 2 Progress -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-yellow-800 mb-4">Level 2</h3>
                <h4 class="font-medium text-yellow-700 mb-3">Laravel API & Database</h4>
                
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-sm">API Validation</span>
                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">6 challenges</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm">Database Query</span>
                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">6 challenges</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm">Cache Strategy</span>
                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">6 challenges</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm">API Response</span>
                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">6 challenges</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm">Relationship Query</span>
                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">6 challenges</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm">Middleware Security</span>
                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">6 challenges</span>
                    </div>
                </div>
                
                <div class="mt-4">
                    <div class="flex justify-between text-sm mb-1">
                        <span>Progress</span>
                        <span>0/6</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-600 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                </div>
                
                <a href="/level2" class="mt-4 block w-full bg-yellow-600 text-white px-4 py-2 rounded text-center hover:bg-yellow-700">
                    Start Level 2
                </a>
            </div>

            <!-- Level 3 Progress -->
            <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-red-800 mb-4">Level 3</h3>
                <h4 class="font-medium text-red-700 mb-3">Advanced Laravel</h4>
                
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-sm">Queue Job</span>
                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">7 challenges</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm">Event System</span>
                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">7 challenges</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm">Collection Operations</span>
                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">7 challenges</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm">Service Container</span>
                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">7 challenges</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm">Testing</span>
                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">7 challenges</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm">Query Builder</span>
                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">7 challenges</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm">Middleware Pipeline</span>
                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">7 challenges</span>
                    </div>
                </div>
                
                <div class="mt-4">
                    <div class="flex justify-between text-sm mb-1">
                        <span>Progress</span>
                        <span>0/7</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-red-600 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                </div>
                
                <a href="/level3" class="mt-4 block w-full bg-red-600 text-white px-4 py-2 rounded text-center hover:bg-red-700">
                    Start Level 3
                </a>
            </div>
        </div>

        <!-- Overall Progress -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h3 class="text-xl font-semibold text-blue-800 mb-4">Overall Progress</h3>
            <div class="grid md:grid-cols-3 gap-4">
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600">0/17</div>
                    <div class="text-sm text-blue-700">Challenges Completed</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600">0</div>
                    <div class="text-sm text-blue-700">Flags Found</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600">0%</div>
                    <div class="text-sm text-blue-700">Total Progress</div>
                </div>
            </div>
            
            <div class="mt-4">
                <div class="flex justify-between text-sm mb-1">
                    <span>Overall Completion</span>
                    <span>0%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-blue-600 h-3 rounded-full" style="width: 0%"></div>
                </div>
            </div>
        </div>

        <!-- Challenge Tips -->
        <div class="mt-8 grid md:grid-cols-2 gap-6">
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">💡 Tips for Success</h3>
                <ul class="text-sm text-gray-700 space-y-2">
                    <li>• Read the error messages carefully - they contain clues</li>
                    <li>• Check browser console and network tabs for hidden flags</li>
                    <li>• Think about what the code is supposed to do vs what it's actually doing</li>
                    <li>• Use browser developer tools to inspect API responses</li>
                    <li>• Some flags may be in logs or require specific input combinations</li>
                </ul>
            </div>
            
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">🎯 Challenge Objectives</h3>
                <ul class="text-sm text-gray-700 space-y-2">
                    <li>• Complete all 17 challenges within 30 minutes</li>
                    <li>• Find all hidden flags by fixing the code issues</li>
                    <li>• Demonstrate senior-level Laravel and PHP knowledge</li>
                    <li>• Show debugging and problem-solving skills</li>
                    <li>• Understand Laravel best practices and architecture</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection