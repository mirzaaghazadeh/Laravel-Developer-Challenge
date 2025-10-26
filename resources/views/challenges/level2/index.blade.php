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

        <!-- Flag Submission -->
        <div class="mt-8 border-t pt-6">
            <h3 class="text-xl font-semibold mb-4">Submit Flags</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <input type="text" id="flagInput" class="w-full border rounded px-3 py-2" 
                           placeholder="Enter your flag (e.g., FLAG_2_...)">
                    <button onclick="submitFlag(5, document.getElementById('flagInput').value)" 
                            class="mt-2 w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Submit Flag
                    </button>
                </div>
                <div class="bg-yellow-50 border border-yellow-200 rounded p-4">
                    <p class="text-sm text-yellow-800">
                        <strong>Hint:</strong> Check API responses carefully - flags are hidden in successful operations!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
            }
        })
        .catch(error => {
            document.getElementById('middlewareResult').innerHTML = 'Error: ' + error.message;
        });
}
</script>
@endsection