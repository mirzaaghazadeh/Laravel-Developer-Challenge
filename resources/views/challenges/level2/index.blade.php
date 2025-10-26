@extends('layouts.challenge')

@section('title', $title)

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-center mb-6 text-yellow-600">{{ $title }}</h1>
        <p class="text-center text-gray-700 mb-8">{{ $description }}</p>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Challenge 1: API Validation -->
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Challenge 1: API Validation</h3>
                <p class="text-gray-600 mb-4">Fix the API validation logic to pass all rules.</p>
                <button onclick="toggleHint(5)" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-3">
                    🤔 Need Help? Click to show hint
                </button>
                <div id="hint-5" class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-3 hidden">
                    <p class="text-sm text-blue-800">📁 <strong>File to fix:</strong> <code class="bg-blue-100 px-2 py-1 rounded">app/Challenges/Level2/LaravelAPIChallenge.php</code></p>
                    <p class="text-xs text-blue-600 mt-1">Look for: <code>brokenValidation()</code> method</p>
                </div>
                
                <div class="space-y-3">
                    <input type="text" id="validationName" class="w-full border rounded px-3 py-2" placeholder="Name">
                    <input type="email" id="validationEmail" class="w-full border rounded px-3 py-2" placeholder="Email">
                    <input type="number" id="validationAge" class="w-full border rounded px-3 py-2" placeholder="Age">
                    <button onclick="testValidationChallenge()" class="w-full bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                        Test Validation
                    </button>
                    <div id="validationResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
                </div>
            </div>

            <!-- Challenge 2: Database Query -->
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Challenge 2: Database Query</h3>
                <p class="text-gray-600 mb-4">Optimize the database query to avoid N+1 problems.</p>
                <button onclick="toggleHint(6)" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-3">
                    🤔 Need Help? Click to show hint
                </button>
                <div id="hint-6" class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-3 hidden">
                    <p class="text-sm text-blue-800">📁 <strong>File to fix:</strong> <code class="bg-blue-100 px-2 py-1 rounded">app/Challenges/Level2/LaravelAPIChallenge.php</code></p>
                    <p class="text-xs text-blue-600 mt-1">Look for: <code>brokenDatabaseQuery()</code> method</p>
                </div>
                
                <div class="space-y-3">
                    <button onclick="testDatabaseChallenge()" class="w-full bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                        Test Query Performance
                    </button>
                    <div id="databaseResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
                </div>
            </div>

            <!-- Challenge 3: Cache Implementation -->
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Challenge 3: Cache Strategy</h3>
                <p class="text-gray-600 mb-4">Fix the caching implementation to avoid key collisions.</p>
                <button onclick="toggleHint(7)" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-3">
                    🤔 Need Help? Click to show hint
                </button>
                <div id="hint-7" class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-3 hidden">
                    <p class="text-sm text-blue-800">📁 <strong>File to fix:</strong> <code class="bg-blue-100 px-2 py-1 rounded">app/Challenges/Level2/LaravelAPIChallenge.php</code></p>
                    <p class="text-xs text-blue-600 mt-1">Look for: <code>brokenCacheImplementation()</code> method</p>
                </div>
                
                <div class="space-y-3">
                    <input type="text" id="cacheKey" class="w-full border rounded px-3 py-2" placeholder="Cache key">
                    <button onclick="testCacheChallenge()" class="w-full bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                        Test Cache
                    </button>
                    <div id="cacheResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
                </div>
            </div>

            <!-- Challenge 4: API Response -->
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Challenge 4: API Response Structure</h3>
                <p class="text-gray-600 mb-4">Fix the API response pagination structure.</p>
                <button onclick="toggleHint(8)" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-3">
                    🤔 Need Help? Click to show hint
                </button>
                <div id="hint-8" class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-3 hidden">
                    <p class="text-sm text-blue-800">📁 <strong>File to fix:</strong> <code class="bg-blue-100 px-2 py-1 rounded">app/Challenges/Level2/LaravelAPIChallenge.php</code></p>
                    <p class="text-xs text-blue-600 mt-1">Look for: <code>brokenAPIResponse()</code> method</p>
                </div>
                
                <div class="space-y-3">
                    <input type="number" id="responsePage" class="w-full border rounded px-3 py-2" placeholder="Page" value="1">
                    <button onclick="testAPIResponseChallenge()" class="w-full bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                        Test API Response
                    </button>
                    <div id="apiResponseResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
                </div>
            </div>

            <!-- Challenge 5: Relationship Query -->
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Challenge 5: Relationship Query</h3>
                <p class="text-gray-600 mb-4">Optimize the Eloquent relationship query.</p>
                <button onclick="toggleHint(9)" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-3">
                    🤔 Need Help? Click to show hint
                </button>
                <div id="hint-9" class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-3 hidden">
                    <p class="text-sm text-blue-800">📁 <strong>File to fix:</strong> <code class="bg-blue-100 px-2 py-1 rounded">app/Challenges/Level2/LaravelAPIChallenge.php</code></p>
                    <p class="text-xs text-blue-600 mt-1">Look for: <code>brokenRelationshipQuery()</code> method</p>
                </div>
                
                <div class="space-y-3">
                    <button onclick="testRelationshipChallenge()" class="w-full bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                        Test Relationship Query
                    </button>
                    <div id="relationshipResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
                </div>
            </div>

            <!-- Challenge 6: Middleware Security -->
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Challenge 6: Middleware Security</h3>
                <p class="text-gray-600 mb-4">Fix the middleware security implementation.</p>
                <button onclick="toggleHint(10)" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-3">
                    🤔 Need Help? Click to show hint
                </button>
                <div id="hint-10" class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-3 hidden">
                    <p class="text-sm text-blue-800">📁 <strong>File to fix:</strong> <code class="bg-blue-100 px-2 py-1 rounded">app/Challenges/Level2/LaravelAPIChallenge.php</code></p>
                    <p class="text-xs text-blue-600 mt-1">Look for: <code>brokenMiddlewareLogic()</code> method</p>
                </div>
                
                <div class="space-y-3">
                    <input type="text" id="middlewareToken" class="w-full border rounded px-3 py-2" placeholder="API Token">
                    <input type="text" id="middlewareRole" class="w-full border rounded px-3 py-2" placeholder="Role">
                    <button onclick="testMiddlewareChallenge()" class="w-full bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                        Test Middleware
                    </button>
                    <div id="middlewareResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
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

// Toggle hint visibility and track usage
function toggleHint(challengeId) {
    const hintElement = document.getElementById('hint-' + challengeId);
    const isHidden = hintElement.classList.contains('hidden');
    
    if (isHidden) {
        hintElement.classList.remove('hidden');
        // Track hint request
        axios.post('/api/progress/hint', { challenge_id: challengeId })
            .then(response => {
                console.log('Hint tracked:', response.data);
                // Refresh stats to show updated hint count
                loadProgressStats();
            })
            .catch(error => {
                console.error('Error tracking hint:', error);
            });
    } else {
        hintElement.classList.add('hidden');
    }
}

function testValidationChallenge() {
    const data = {
        name: document.getElementById('validationName').value,
        email: document.getElementById('validationEmail').value,
        age: document.getElementById('validationAge').value
    };
    
    axios.post('/level2/validation', data)
        .then(response => {
            const result = document.getElementById('validationResult');
            result.innerHTML = `
                <div><strong>Success:</strong> ${response.data.result.success}</div>
                <div><strong>Message:</strong> ${response.data.result.message || 'Validation failed'}</div>
                <div><strong>Hint:</strong> ${response.data.hint}</div>
                ${response.data.result.flag ? `<div class="text-green-600"><strong>FLAG:</strong> ${response.data.result.flag}</div>` : ''}
            `;
            
            if (response.data.result.flag) {
                result.classList.add('flag-found');
                showNotification('Flag found in validation challenge!', 'success');
                // Automatically update progress
                submitFlag(5, response.data.result.flag);
            }
        })
        .catch(error => {
            document.getElementById('validationResult').innerHTML = 'Error: ' + error.message;
        });
}

function testDatabaseChallenge() {
    axios.get('/level2/database')
        .then(response => {
            const result = document.getElementById('databaseResult');
            result.innerHTML = `
                <div><strong>Query Count:</strong> ${response.data.result.query_count}</div>
                <div><strong>Users Count:</strong> ${response.data.result.users.length}</div>
                <div><strong>Hint:</strong> ${response.data.result.hint || 'Check query optimization'}</div>
                ${response.data.result.flag ? `<div class="text-green-600"><strong>FLAG:</strong> ${response.data.result.flag}</div>` : ''}
            `;
            
            if (response.data.result.flag) {
                result.classList.add('flag-found');
                showNotification('Flag found in database challenge!', 'success');
                // Automatically update progress
                submitFlag(6, response.data.result.flag);
            }
        })
        .catch(error => {
            document.getElementById('databaseResult').innerHTML = 'Error: ' + error.message;
        });
}

function testCacheChallenge() {
    const key = document.getElementById('cacheKey').value || 'test_key_' + Date.now();
    
    axios.post('/level2/cache', { key: key })
        .then(response => {
            const result = document.getElementById('cacheResult');
            result.innerHTML = `
                <div><strong>Source:</strong> ${response.data.result.source}</div>
                <div><strong>Key:</strong> ${key}</div>
                ${response.data.result.flag ? `<div class="text-green-600"><strong>FLAG:</strong> ${response.data.result.flag}</div>` : ''}
            `;
            
            if (response.data.result.flag) {
                result.classList.add('flag-found');
                showNotification('Flag found in cache challenge!', 'success');
                // Automatically update progress
                submitFlag(7, response.data.result.flag);
            }
        })
        .catch(error => {
            document.getElementById('cacheResult').innerHTML = 'Error: ' + error.message;
        });
}

function testAPIResponseChallenge() {
    const page = parseInt(document.getElementById('responsePage').value) || 1;
    const items = Array.from({length: 50}, (_, i) => i + 1);
    
    axios.post('/level2/api-response', { items: items, page: page })
        .then(response => {
            const result = document.getElementById('apiResponseResult');
            const pagination = response.data.result.pagination;
            result.innerHTML = `
                <div><strong>Current Page:</strong> ${pagination.current_page}</div>
                <div><strong>Total Items:</strong> ${pagination.total}</div>
                <div><strong>Items on Page:</strong> ${response.data.result.data.length}</div>
                ${response.data.result.flag ? `<div class="text-green-600"><strong>FLAG:</strong> ${response.data.result.flag}</div>` : ''}
            `;
            
            if (response.data.result.flag) {
                result.classList.add('flag-found');
                showNotification('Flag found in API response challenge!', 'success');
                // Automatically update progress
                submitFlag(8, response.data.result.flag);
            }
        })
        .catch(error => {
            document.getElementById('apiResponseResult').innerHTML = 'Error: ' + error.message;
        });
}

function testRelationshipChallenge() {
    axios.get('/level2/relationship')
        .then(response => {
            const result = document.getElementById('relationshipResult');
            result.innerHTML = `
                <div><strong>Query Count:</strong> ${response.data.result.query_count}</div>
                <div><strong>Users Found:</strong> ${response.data.result.users.length}</div>
                <div><strong>Hint:</strong> ${response.data.result.hint || 'Check query efficiency'}</div>
                ${response.data.result.flag ? `<div class="text-green-600"><strong>FLAG:</strong> ${response.data.result.flag}</div>` : ''}
            `;
            
            if (response.data.result.flag) {
                result.classList.add('flag-found');
                showNotification('Flag found in relationship challenge!', 'success');
                // Automatically update progress
                submitFlag(9, response.data.result.flag);
            }
        })
        .catch(error => {
            document.getElementById('relationshipResult').innerHTML = 'Error: ' + error.message;
        });
}

function testMiddlewareChallenge() {
    const data = {
        api_key: document.getElementById('middlewareToken').value,
        role: document.getElementById('middlewareRole').value,
        timestamp: Math.floor(Date.now() / 1000)
    };
    
    axios.post('/level2/middleware', data)
        .then(response => {
            const result = document.getElementById('middlewareResult');
            result.innerHTML = `
                <div><strong>Success:</strong> ${response.data.result.success}</div>
                <div><strong>Message:</strong> ${response.data.result.message || response.data.result.error}</div>
                ${response.data.result.flag ? `<div class="text-green-600"><strong>FLAG:</strong> ${response.data.result.flag}</div>` : ''}
            `;
            
            if (response.data.result.flag) {
                result.classList.add('flag-found');
                showNotification('Flag found in middleware challenge!', 'success');
                // Automatically update progress
                submitFlag(10, response.data.result.flag);
            }
        })
        .catch(error => {
            document.getElementById('middlewareResult').innerHTML = 'Error: ' + error.message;
        });
}
</script>
@endsection