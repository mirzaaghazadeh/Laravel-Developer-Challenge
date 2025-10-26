@extends('layouts.challenge')

@section('title', $title)

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-center mb-6 text-red-600">{{ $title }}</h1>
        <p class="text-center text-gray-700 mb-8">{{ $description }}</p>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Challenge 1: Queue Job -->
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Challenge 1: Queue Job</h3>
                <p class="text-gray-600 mb-4">Fix the queue job implementation for proper async processing.</p>
                <button onclick="toggleHint(11)" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-3">
                    🤔 Need Help? Click to show hint
                </button>
                <div id="hint-11" class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-3 hidden">
                    <p class="text-sm text-blue-800">📁 <strong>File to fix:</strong> <code class="bg-blue-100 px-2 py-1 rounded">app/Challenges/Level3/AdvancedLaravelChallenge.php</code></p>
                    <p class="text-xs text-blue-600 mt-1">Look for: <code>brokenQueueJob()</code> method</p>
                </div></div>
                
                <div class="space-y-3">
                    <textarea id="queueData" class="w-full border rounded px-3 py-2" rows="3" placeholder='{"test": "data"}'>{"test": "queue_data"}</textarea>
                    <button onclick="testQueueChallenge()" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Test Queue Job
                    </button>
                    <div id="queueResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
                </div>
            </div>

            <!-- Challenge 2: Event System -->
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Challenge 2: Event System</h3>
                <p class="text-gray-600 mb-4">Fix the event system to properly fire and listen to events.</p>
                <button onclick="toggleHint(12)" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-3">
                    🤔 Need Help? Click to show hint
                </button>
                <div id="hint-12" class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-3 hidden">
                    <p class="text-sm text-blue-800">📁 <strong>File to fix:</strong> <code class="bg-blue-100 px-2 py-1 rounded">app/Challenges/Level3/AdvancedLaravelChallenge.php</code></p>
                    <p class="text-xs text-blue-600 mt-1">Look for: <code>brokenEventSystem()</code> method</p>
                </div></div>
                
                <div class="space-y-3">
                    <textarea id="eventPayload" class="w-full border rounded px-3 py-2" rows="3" placeholder='{"event": "data"}'>{"event": "test_data"}</textarea>
                    <button onclick="testEventChallenge()" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Test Event System
                    </button>
                    <div id="eventResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
                </div>
            </div>

            <!-- Challenge 3: Collection -->
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Challenge 3: Collection Operations</h3>
                <p class="text-gray-600 mb-4">Advanced collection manipulation with filtering and mapping.</p>
                <button onclick="toggleHint(13)" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-3">
                    🤔 Need Help? Click to show hint
                </button>
                <div id="hint-13" class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-3 hidden">
                    <p class="text-sm text-blue-800">📁 <strong>File to fix:</strong> <code class="bg-blue-100 px-2 py-1 rounded">app/Challenges/Level3/AdvancedLaravelChallenge.php</code></p>
                    <p class="text-xs text-blue-600 mt-1">Look for: <code>collectionChallenge()</code> method</p>
                </div></div>
                
                <div class="space-y-3">
                    <textarea id="collectionData" class="w-full border rounded px-3 py-2" rows="4" placeholder='Array of objects'>[{"name": "Item 1", "active": true, "score": 30}, {"name": "Item 2", "active": false, "score": 50}, {"name": "Item 3", "active": true, "score": 70}]</textarea>
                    <button onclick="testCollectionChallenge()" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Test Collection
                    </button>
                    <div id="collectionResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
                </div>
            </div>

            <!-- Challenge 4: Service Container -->
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Challenge 4: Service Container</h3>
                <p class="text-gray-600 mb-4">Test dependency injection and service container resolution.</p>
                <button onclick="toggleHint(14)" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-3">
                    🤔 Need Help? Click to show hint
                </button>
                <div id="hint-14" class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-3 hidden">
                    <p class="text-sm text-blue-800">📁 <strong>File to fix:</strong> <code class="bg-blue-100 px-2 py-1 rounded">app/Challenges/Level3/AdvancedLaravelChallenge.php</code></p>
                    <p class="text-xs text-blue-600 mt-1">Look for: <code>serviceContainerChallenge()</code> method</p>
                </div></div>
                
                <div class="space-y-3">
                    <button onclick="testServiceContainerChallenge()" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Test Service Container
                    </button>
                    <div id="serviceContainerResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
                </div>
            </div>

            <!-- Challenge 5: Testing -->
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Challenge 5: Testing Assertions</h3>
                <p class="text-gray-600 mb-4">Write proper test assertions to validate data structure.</p>
                <button onclick="toggleHint(15)" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-3">
                    🤔 Need Help? Click to show hint
                </button>
                <div id="hint-15" class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-3 hidden">
                    <p class="text-sm text-blue-800">📁 <strong>File to fix:</strong> <code class="bg-blue-100 px-2 py-1 rounded">app/Challenges/Level3/AdvancedLaravelChallenge.php</code></p>
                    <p class="text-xs text-blue-600 mt-1">Look for: <code>testingChallenge()</code> method</p>
                </div></div>
                
                <div class="space-y-3">
                    <textarea id="testData" class="w-full border rounded px-3 py-2" rows="3" placeholder='Test data structure'>{"id": 123, "count": 42, "status": "active"}</textarea>
                    <button onclick="testTestingChallenge()" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Run Tests
                    </button>
                    <div id="testingResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
                </div>
            </div>

            <!-- Challenge 6: Query Builder -->
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Challenge 6: Advanced Query Builder</h3>
                <p class="text-gray-600 mb-4">Complex database operations with joins and aggregations.</p>
                <button onclick="toggleHint(16)" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-3">
                    🤔 Need Help? Click to show hint
                </button>
                <div id="hint-16" class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-3 hidden">
                    <p class="text-sm text-blue-800">📁 <strong>File to fix:</strong> <code class="bg-blue-100 px-2 py-1 rounded">app/Challenges/Level3/AdvancedLaravelChallenge.php</code></p>
                    <p class="text-xs text-blue-600 mt-1">Look for: <code>advancedQueryBuilderChallenge()</code> method</p>
                </div></div>
                
                <div class="space-y-3">
                    <button onclick="testQueryBuilderChallenge()" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Test Query Builder
                    </button>
                    <div id="queryBuilderResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
                </div>
            </div>

            <!-- Challenge 7: Middleware Pipeline -->
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Challenge 7: Middleware Pipeline</h3>
                <p class="text-gray-600 mb-4">Advanced middleware implementation with multiple stages.</p>
                <button onclick="toggleHint(17)" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-3">
                    🤔 Need Help? Click to show hint
                </button>
                <div id="hint-17" class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-3 hidden">
                    <p class="text-sm text-blue-800">📁 <strong>File to fix:</strong> <code class="bg-blue-100 px-2 py-1 rounded">app/Challenges/Level3/AdvancedLaravelChallenge.php</code></p>
                    <p class="text-xs text-blue-600 mt-1">Look for: <code>middlewarePipelineChallenge()</code> method</p>
                </div></div>
                
                <div class="space-y-3">
                    <textarea id="pipelineRequest" class="w-full border rounded px-3 py-2" rows="3" placeholder='Request data'>{"token": "valid_token_12345", "role": "admin", "data": {"test": "payload"}}</textarea>
                    <button onclick="testMiddlewarePipelineChallenge()" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Test Pipeline
                    </button>
                    <div id="pipelineResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
                </div>
            </div>
        </div>

        <!-- Overall Statistics -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h3 class="text-xl font-semibold text-blue-800 mb-4">📊 Overall Statistics</h3>
            <div class="grid md:grid-cols-5 gap-4">
                <div class="text-center">
                    <div class="text-2xl font-bold text-blue-600" id="stats-completed">0/17</div>
                    <div class="text-sm text-blue-700">Completed</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600" id="stats-level1">0/4</div>
                    <div class="text-sm text-green-700">Level 1</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-yellow-600" id="stats-level2">0/6</div>
                    <div class="text-sm text-yellow-700">Level 2</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-red-600" id="stats-level3">0/7</div>
                    <div class="text-sm text-red-700">Level 3</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-purple-600" id="stats-hints">0</div>
                    <div class="text-sm text-purple-700">💡 Hints Used</div>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex justify-between text-sm mb-1">
                    <span class="text-blue-700">Overall Progress</span>
                    <span class="text-blue-700" id="stats-percentage">0%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-blue-600 h-3 rounded-full transition-all duration-500" id="stats-progress-bar" style="width: 0%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Load and display progress statistics
function loadProgressStats() {
    axios.get('/api/progress')
        .then(response => {
            const progress = response.data;
            updateStatsDisplay(progress);
        })
        .catch(error => {
            console.error('Error loading progress:', error);
        });
}

// Update statistics display
function updateStatsDisplay(progress) {
    const level1Count = progress.completed_challenges.filter(id => id >= 1 && id <= 4).length;
    const level2Count = progress.completed_challenges.filter(id => id >= 5 && id <= 10).length;
    const level3Count = progress.completed_challenges.filter(id => id >= 11 && id <= 17).length;
    const totalPercentage = Math.round((progress.total_completed / progress.total_challenges) * 100);
    
    document.getElementById('stats-completed').textContent = `${progress.total_completed}/17`;
    document.getElementById('stats-level1').textContent = `${level1Count}/4`;
    document.getElementById('stats-level2').textContent = `${level2Count}/6`;
    document.getElementById('stats-level3').textContent = `${level3Count}/7`;
    document.getElementById('stats-hints').textContent = `${progress.hints_requested || 0}`;
    document.getElementById('stats-percentage').textContent = `${totalPercentage}%`;
    document.getElementById('stats-progress-bar').style.width = `${totalPercentage}%`;
}

// Initialize stats on page load
document.addEventListener('DOMContentLoaded', function() {
    loadProgressStats();
    // Refresh stats every 3 seconds
    setInterval(loadProgressStats, 3000);
});

<script>
function testQueueChallenge() {
    let data;
    try {
        data = JSON.parse(document.getElementById('queueData').value);
    } catch (e) {
        data = { test: 'queue_data' };
    }
    
    axios.post('/level3/queue', { data: data })
        .then(response => {
            const result = document.getElementById('queueResult');
            result.innerHTML = `
                <div><strong>Success:</strong> ${response.data.result.success}</div>
                <div><strong>Message:</strong> ${response.data.result.message || response.data.result.error}</div>
                <div><strong>Hint:</strong> ${response.data.result.hint}</div>
                ${response.data.result.flag ? `<div class="text-green-600"><strong>FLAG:</strong> ${response.data.result.flag}</div>` : ''}
            `;
            
            if (response.data.result.flag) {
                result.classList.add('flag-found');
                showNotification('Flag found in queue challenge!', 'success');
            }
        })
        .catch(error => {
            document.getElementById('queueResult').innerHTML = 'Error: ' + error.message;
        });
}

function testEventChallenge() {
    let payload;
    try {
        payload = JSON.parse(document.getElementById('eventPayload').value);
    } catch (e) {
        payload = { event: 'test_data' };
    }
    
    axios.post('/level3/event', { payload: payload })
        .then(response => {
            const result = document.getElementById('eventResult');
            result.innerHTML = `
                <div><strong>Success:</strong> ${response.data.result.success}</div>
                <div><strong>Message:</strong> ${response.data.result.message}</div>
                <div><strong>Event Fired:</strong> ${response.data.result.event_fired}</div>
                <div><strong>Listener Executed:</strong> ${response.data.result.listener_executed}</div>
                ${response.data.result.flag ? `<div class="text-green-600"><strong>FLAG:</strong> ${response.data.result.flag}</div>` : ''}
            `;
            
            if (response.data.result.flag) {
                result.classList.add('flag-found');
                showNotification('Flag found in event challenge!', 'success');
            }
        })
        .catch(error => {
            document.getElementById('eventResult').innerHTML = 'Error: ' + error.message;
        });
}

function testCollectionChallenge() {
    let data;
    try {
        data = JSON.parse(document.getElementById('collectionData').value);
    } catch (e) {
        data = [
            {name: "Item 1", active: true, score: 30},
            {name: "Item 2", active: false, score: 50},
            {name: "Item 3", active: true, score: 70},
            {name: "Item 4", active: true, score: 40},
            {name: "Item 5", active: true, score: 60}
        ];
    }
    
    axios.post('/level3/collection', { data: data })
        .then(response => {
            const result = document.getElementById('collectionResult');
            const stats = response.data.result.stats || {};
            result.innerHTML = `
                <div><strong>Success:</strong> ${response.data.result.success}</div>
                <div><strong>Items Processed:</strong> ${response.data.result.result ? response.data.result.result.length : 0}</div>
                <div><strong>Total Score:</strong> ${stats.total_score || 0}</div>
                <div><strong>Average Score:</strong> ${stats.average_score || 0}</div>
                <div><strong>Hint:</strong> ${response.data.result.hint}</div>
                ${response.data.result.flag ? `<div class="text-green-600"><strong>FLAG:</strong> ${response.data.result.flag}</div>` : ''}
            `;
            
            if (response.data.result.flag) {
                result.classList.add('flag-found');
                showNotification('Flag found in collection challenge!', 'success');
            }
        })
        .catch(error => {
            document.getElementById('collectionResult').innerHTML = 'Error: ' + error.message;
        });
}

function testServiceContainerChallenge() {
    axios.get('/level3/service-container')
        .then(response => {
            const result = document.getElementById('serviceContainerResult');
            result.innerHTML = `
                <div><strong>Success:</strong> ${response.data.result.success}</div>
                <div><strong>Message:</strong> ${response.data.result.message || response.data.result.error}</div>
                <div><strong>Hint:</strong> ${response.data.result.hint}</div>
                ${response.data.result.flag ? `<div class="text-green-600"><strong>FLAG:</strong> ${response.data.result.flag}</div>` : ''}
            `;
            
            if (response.data.result.flag) {
                result.classList.add('flag-found');
                showNotification('Flag found in service container challenge!', 'success');
            }
        })
        .catch(error => {
            document.getElementById('serviceContainerResult').innerHTML = 'Error: ' + error.message;
        });
}

function testTestingChallenge() {
    let testData;
    try {
        testData = JSON.parse(document.getElementById('testData').value);
    } catch (e) {
        testData = { id: 123, count: 42, status: 'active' };
    }
    
    axios.post('/level3/testing', { test_data: testData })
        .then(response => {
            const result = document.getElementById('testingResult');
            const tests = response.data.result.tests || {};
            result.innerHTML = `
                <div><strong>Success:</strong> ${response.data.result.success}</div>
                <div><strong>Test 1 (ArrayHasKey):</strong> ${tests.test1 ? tests.test1.passed : 'false'}</div>
                <div><strong>Test 2 (IsInt):</strong> ${tests.test2 ? tests.test2.passed : 'false'}</div>
                <div><strong>Test 3 (Equals):</strong> ${tests.test3 ? tests.test3.passed : 'false'}</div>
                <div><strong>Hint:</strong> ${response.data.result.hint}</div>
                ${response.data.result.flag ? `<div class="text-green-600"><strong>FLAG:</strong> ${response.data.result.flag}</div>` : ''}
            `;
            
            if (response.data.result.flag) {
                result.classList.add('flag-found');
                showNotification('Flag found in testing challenge!', 'success');
            }
        })
        .catch(error => {
            document.getElementById('testingResult').innerHTML = 'Error: ' + error.message;
        });
}

function testQueryBuilderChallenge() {
    axios.get('/level3/query-builder')
        .then(response => {
            const result = document.getElementById('queryBuilderResult');
            result.innerHTML = `
                <div><strong>Success:</strong> ${response.data.result.success}</div>
                <div><strong>Results Count:</strong> ${response.data.result.results ? response.data.result.results.length : 0}</div>
                <div><strong>Hint:</strong> ${response.data.result.hint}</div>
                ${response.data.result.flag ? `<div class="text-green-600"><strong>FLAG:</strong> ${response.data.result.flag}</div>` : ''}
            `;
            
            if (response.data.result.flag) {
                result.classList.add('flag-found');
                showNotification('Flag found in query builder challenge!', 'success');
            }
        })
        .catch(error => {
            document.getElementById('queryBuilderResult').innerHTML = 'Error: ' + error.message;
        });
}

function testMiddlewarePipelineChallenge() {
    let requestData;
    try {
        requestData = JSON.parse(document.getElementById('pipelineRequest').value);
    } catch (e) {
        requestData = { token: 'valid_token_12345', role: 'admin', data: { test: 'payload' } };
    }
    
    axios.post('/level3/middleware-pipeline', { request: requestData })
        .then(response => {
            const result = document.getElementById('pipelineResult');
            result.innerHTML = `
                <div><strong>Success:</strong> ${response.data.result.success}</div>
                <div><strong>Executed Stages:</strong> ${response.data.result.executed ? response.data.result.executed.join(', ') : 'none'}</div>
                <div><strong>Failed At:</strong> ${response.data.result.failed_at || 'none'}</div>
                <div><strong>Hint:</strong> ${response.data.result.hint}</div>
                ${response.data.result.flag ? `<div class="text-green-600"><strong>FLAG:</strong> ${response.data.result.flag}</div>` : ''}
            `;
            
            if (response.data.result.flag) {
                result.classList.add('flag-found');
                showNotification('Flag found in middleware pipeline challenge!', 'success');
            }
        })
        .catch(error => {
            document.getElementById('pipelineResult').innerHTML = 'Error: ' + error.message;
        });
}
</script>
@endsection