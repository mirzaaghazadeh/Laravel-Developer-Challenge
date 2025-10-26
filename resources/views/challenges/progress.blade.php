@extends('layouts.challenge')

@section('title', $title)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-center mb-8 text-blue-600">{{ $title }}</h1>

        <!-- Overall Statistics -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-blue-800 mb-4">Overall Statistics</h2>
            <div class="grid md:grid-cols-4 gap-4">
                <div class="text-center">
                    <div class="text-2xl font-bold text-blue-600">{{ $total_challenges }}</div>
                    <div class="text-sm text-blue-700">Total Challenges</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600">0</div>
                    <div class="text-sm text-green-700">Completed</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-yellow-600">0</div>
                    <div class="text-sm text-yellow-700">In Progress</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-red-600">{{ $total_challenges }}</div>
                    <div class="text-sm text-red-700">Remaining</div>
                </div>
            </div>
        </div>

        <!-- Level Progress -->
        <div class="space-y-6 mb-8">
            <!-- Level 1 -->
            <div class="border rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Level 1: PHP Logic & Debugging</h3>
                    <span class="text-sm bg-gray-200 px-3 py-1 rounded-full">0/4 completed</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                    <div class="bg-green-600 h-3 rounded-full" style="width: 0%"></div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <div class="text-center p-3 bg-gray-100 rounded">
                        <div class="text-xs text-gray-600">Array Function</div>
                        <div class="text-sm font-medium">❌</div>
                    </div>
                    <div class="text-center p-3 bg-gray-100 rounded">
                        <div class="text-xs text-gray-600">String Manipulation</div>
                        <div class="text-sm font-medium">❌</div>
                    </div>
                    <div class="text-center p-3 bg-gray-100 rounded">
                        <div class="text-xs text-gray-600">Factorial</div>
                        <div class="text-sm font-medium">❌</div>
                    </div>
                    <div class="text-center p-3 bg-gray-100 rounded">
                        <div class="text-xs text-gray-600">Caesar Cipher</div>
                        <div class="text-sm font-medium">❌</div>
                    </div>
                </div>
            </div>

            <!-- Level 2 -->
            <div class="border rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Level 2: Laravel API & Database</h3>
                    <span class="text-sm bg-gray-200 px-3 py-1 rounded-full">0/6 completed</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                    <div class="bg-yellow-600 h-3 rounded-full" style="width: 0%"></div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    <div class="text-center p-3 bg-gray-100 rounded">
                        <div class="text-xs text-gray-600">API Validation</div>
                        <div class="text-sm font-medium">❌</div>
                    </div>
                    <div class="text-center p-3 bg-gray-100 rounded">
                        <div class="text-xs text-gray-600">Database Query</div>
                        <div class="text-sm font-medium">❌</div>
                    </div>
                    <div class="text-center p-3 bg-gray-100 rounded">
                        <div class="text-xs text-gray-600">Cache Strategy</div>
                        <div class="text-sm font-medium">❌</div>
                    </div>
                    <div class="text-center p-3 bg-gray-100 rounded">
                        <div class="text-xs text-gray-600">API Response</div>
                        <div class="text-sm font-medium">❌</div>
                    </div>
                    <div class="text-center p-3 bg-gray-100 rounded">
                        <div class="text-xs text-gray-600">Relationship Query</div>
                        <div class="text-sm font-medium">❌</div>
                    </div>
                    <div class="text-center p-3 bg-gray-100 rounded">
                        <div class="text-xs text-gray-600">Middleware Security</div>
                        <div class="text-sm font-medium">❌</div>
                    </div>
                </div>
            </div>

            <!-- Level 3 -->
            <div class="border rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Level 3: Advanced Laravel</h3>
                    <span class="text-sm bg-gray-200 px-3 py-1 rounded-full">0/7 completed</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                    <div class="bg-red-600 h-3 rounded-full" style="width: 0%"></div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <div class="text-center p-3 bg-gray-100 rounded">
                        <div class="text-xs text-gray-600">Queue Job</div>
                        <div class="text-sm font-medium">❌</div>
                    </div>
                    <div class="text-center p-3 bg-gray-100 rounded">
                        <div class="text-xs text-gray-600">Event System</div>
                        <div class="text-sm font-medium">❌</div>
                    </div>
                    <div class="text-center p-3 bg-gray-100 rounded">
                        <div class="text-xs text-gray-600">Collections</div>
                        <div class="text-sm font-medium">❌</div>
                    </div>
                    <div class="text-center p-3 bg-gray-100 rounded">
                        <div class="text-xs text-gray-600">Service Container</div>
                        <div class="text-sm font-medium">❌</div>
                    </div>
                    <div class="text-center p-3 bg-gray-100 rounded">
                        <div class="text-xs text-gray-600">Testing</div>
                        <div class="text-sm font-medium">❌</div>
                    </div>
                    <div class="text-center p-3 bg-gray-100 rounded">
                        <div class="text-xs text-gray-600">Query Builder</div>
                        <div class="text-sm font-medium">❌</div>
                    </div>
                    <div class="text-center p-3 bg-gray-100 rounded">
                        <div class="text-xs text-gray-600">Middleware Pipeline</div>
                        <div class="text-sm font-medium">❌</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Flag Collection -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-yellow-800 mb-4">🏁 Flag Collection</h2>
            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <h4 class="font-medium text-yellow-700 mb-2">Level 1 Flags</h4>
                    <div class="space-y-1">
                        <div class="text-sm text-yellow-600">FLAG_1_ARRAY_FIX_????????</div>
                        <div class="text-sm text-yellow-600">FLAG_1_STRING_????????</div>
                        <div class="text-sm text-yellow-600">FLAG_1_FACTORIAL_????????</div>
                        <div class="text-sm text-yellow-600">FLAG_1_DECODE_????????</div>
                    </div>
                </div>
                <div>
                    <h4 class="font-medium text-yellow-700 mb-2">Level 2 Flags</h4>
                    <div class="space-y-1">
                        <div class="text-sm text-yellow-600">FLAG_2_VALIDATION_????????</div>
                        <div class="text-sm text-yellow-600">FLAG_2_DATABASE_????????</div>
                        <div class="text-sm text-yellow-600">FLAG_2_CACHE_????????</div>
                        <div class="text-sm text-yellow-600">FLAG_2_API_????????</div>
                        <div class="text-sm text-yellow-600">FLAG_2_RELATIONSHIP_????????</div>
                        <div class="text-sm text-yellow-600">FLAG_2_SECURITY_????????</div>
                    </div>
                </div>
                <div>
                    <h4 class="font-medium text-yellow-700 mb-2">Level 3 Flags</h4>
                    <div class="space-y-1">
                        <div class="text-sm text-yellow-600">FLAG_3_QUEUE_????????</div>
                        <div class="text-sm text-yellow-600">FLAG_3_EVENT_????????</div>
                        <div class="text-sm text-yellow-600">FLAG_3_COLLECTION_????????</div>
                        <div class="text-sm text-yellow-600">FLAG_3_CONTAINER_????????</div>
                        <div class="text-sm text-yellow-600">FLAG_3_TESTING_????????</div>
                        <div class="text-sm text-yellow-600">FLAG_3_QUERY_????????</div>
                        <div class="text-sm text-yellow-600">FLAG_3_MIDDLEWARE_????????</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Time Tracking -->
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">⏱️ Time Tracking</h2>
            <div class="grid md:grid-cols-3 gap-4">
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-600">00:00</div>
                    <div class="text-sm text-gray-700">Time Elapsed</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-600">30:00</div>
                    <div class="text-sm text-gray-700">Time Limit</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-600">30:00</div>
                    <div class="text-sm text-gray-700">Time Remaining</div>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex justify-between text-sm mb-1">
                    <span>Time Progress</span>
                    <span>0%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-gray-600 h-3 rounded-full" style="width: 0%"></div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 flex justify-center space-x-4">
            <a href="/dashboard" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                Back to Dashboard
            </a>
            <button onclick="resetProgress()" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700">
                Reset Progress
            </button>
        </div>
    </div>
</div>

<script>
function resetProgress() {
    if (confirm('Are you sure you want to reset all progress? This will clear all completed challenges and found flags.')) {
        // In a real implementation, this would make an API call to reset progress
        showNotification('Progress reset successfully!', 'success');
        setTimeout(() => {
            window.location.reload();
        }, 1000);
    }
}

// Update time tracking (in a real implementation, this would sync with server)
let startTime = Date.now();
setInterval(() => {
    const elapsed = Math.floor((Date.now() - startTime) / 1000);
    const minutes = Math.floor(elapsed / 60);
    const seconds = elapsed % 60;
    const remaining = Math.max(0, 1800 - elapsed); // 30 minutes in seconds
    const remainingMinutes = Math.floor(remaining / 60);
    const remainingSeconds = remaining % 60;
    
    // Update display (would need to add IDs to the HTML elements)
    console.log(`Time: ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')} | Remaining: ${remainingMinutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`);
}, 1000);
</script>
@endsection