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
                
                <div class="space-y-3">
                    <textarea id="pipelineRequest" class="w-full border rounded px-3 py-2" rows="3" placeholder='Request data'>{"token": "valid_token_12345", "role": "admin", "data": {"test": "payload"}}</textarea>
                    <button onclick="testMiddlewarePipelineChallenge()" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Test Pipeline
                    </button>
                    <div id="pipelineResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
                </div>
            </div>
        </div>

        <!-- Flag Submission -->
        <div class="mt-8 border-t pt-6">
            <h3 class="text-xl font-semibold mb-4">Submit Flags</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <input type="text" id="flagInput" class="w-full border rounded px-3 py-2" 
                           placeholder="Enter your flag (e.g., FLAG_3_...)">
                    <button onclick="submitFlag(11, document.getElementById('flagInput').value)" 
                            class="mt-2 w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Submit Flag
                    </button>
                </div>
                <div class="bg-red-50 border border-red-200 rounded p-4">
                    <p class="text-sm text-red-800">
                        <strong>Advanced Hint:</strong> These challenges require deep Laravel knowledge. Check logs, service providers, and architecture patterns!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

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