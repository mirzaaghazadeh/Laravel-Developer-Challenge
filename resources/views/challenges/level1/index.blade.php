@extends('layouts.challenge')

@section('title', $title)

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-center mb-6 text-green-600">{{ $title }}</h1>
        <p class="text-center text-gray-700 mb-8">{{ $description }}</p>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Challenge 1: Array Function -->
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Challenge 1: Array Function</h3>
                <p class="text-gray-600 mb-4">Fix the broken array function that should sum even numbers.</p>
                <button onclick="toggleHint(1)" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-3">
                    🤔 Need Help? Click to show hint
                </button>
                <div id="hint-1" class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-3 hidden">
                    <p class="text-sm text-blue-800">📁 <strong>File to fix:</strong> <code class="bg-blue-100 px-2 py-1 rounded">app/Challenges/Level1/PHPLogicChallenge.php</code></p>
                    <p class="text-xs text-blue-600 mt-1">Look for: <code>brokenArrayFunction()</code> method</p>
                </div>
                
                <div class="bg-gray-100 p-4 rounded mb-4">
                    <code class="text-sm">
                        function brokenArrayFunction($numbers) {<br>
                        &nbsp;&nbsp;$sum = 0;<br>
                        &nbsp;&nbsp;foreach ($numbers as $number) {<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;if ($number % 2 != 0) {<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sum += $number;<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                        &nbsp;&nbsp;}<br>
                        &nbsp;&nbsp;return $sum;<br>
                        }
                    </code>
                </div>

                <div class="space-y-3">
                    <input type="text" id="arrayInput" class="w-full border rounded px-3 py-2" 
                           placeholder="Enter numbers (comma-separated)" value="1,2,3,4,5,6,7,8,9,10">
                    <button onclick="testArrayChallenge()" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Test Function
                    </button>
                    <div id="arrayResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
                </div>
            </div>

            <!-- Challenge 2: String Manipulation -->
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Challenge 2: String Manipulation</h3>
                <p class="text-gray-600 mb-4">Fix the string manipulation to extract the hidden message.</p>
                <button onclick="toggleHint(2)" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-3">
                    🤔 Need Help? Click to show hint
                </button>
                <div id="hint-2" class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-3 hidden">
                    <p class="text-sm text-blue-800">📁 <strong>File to fix:</strong> <code class="bg-blue-100 px-2 py-1 rounded">app/Challenges/Level1/PHPLogicChallenge.php</code></p>
                    <p class="text-xs text-blue-600 mt-1">Look for: <code>brokenStringManipulation()</code> method</p>
                </div>
                
                <div class="bg-gray-100 p-4 rounded mb-4">
                    <code class="text-sm">
                        function brokenStringManipulation($input) {<br>
                        &nbsp;&nbsp;$reversed = strrev($input);<br>
                        &nbsp;&nbsp;$result = '';<br>
                        &nbsp;&nbsp;for ($i = 0; $i < strlen($reversed); $i += 2) {<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;$result .= $reversed[$i];<br>
                        &nbsp;&nbsp;}<br>
                        &nbsp;&nbsp;return $result;<br>
                        }
                    </code>
                </div>

                <div class="space-y-3">
                    <input type="text" id="stringInput" class="w-full border rounded px-3 py-2" 
                           placeholder="Enter string to decode" value="__G__N__I__R__T__S_____1_____G__A__L__F">
                    <button onclick="testStringChallenge()" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Test Function
                    </button>
                    <div id="stringResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
                </div>
            </div>

            <!-- Challenge 3: Factorial -->
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Challenge 3: Factorial Function</h3>
                <p class="text-gray-600 mb-4">Calculate factorial correctly and submit your answer.</p>
                <button onclick="toggleHint(3)" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-3">
                    🤔 Need Help? Click to show hint
                </button>
                <div id="hint-3" class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-3 hidden">
                    <p class="text-sm text-blue-800">📁 <strong>File to fix:</strong> <code class="bg-blue-100 px-2 py-1 rounded">app/Challenges/Level1/PHPLogicChallenge.php</code></p>
                    <p class="text-xs text-blue-600 mt-1">Look for: <code>brokenFactorial()</code> method</p>
                </div>
                
                <div class="bg-gray-100 p-4 rounded mb-4">
                    <code class="text-sm">
                        function brokenFactorial($n) {<br>
                        &nbsp;&nbsp;if ($n <= 1) {<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;return 1;<br>
                        &nbsp;&nbsp;}<br>
                        &nbsp;&nbsp;return $n * brokenFactorial($n - 1);<br>
                        }
                    </code>
                </div>

                <div class="space-y-3">
                    <input type="number" id="factorialN" class="w-full border rounded px-3 py-2" 
                           placeholder="Enter n" value="5">
                    <input type="number" id="factorialAnswer" class="w-full border rounded px-3 py-2" 
                           placeholder="Your answer for n!" value="120">
                    <button onclick="testFactorialChallenge()" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Submit Answer
                    </button>
                    <div id="factorialResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
                </div>
            </div>

            <!-- Challenge 4: String Decoding -->
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-3">Challenge 4: Caesar Cipher</h3>
                <p class="text-gray-600 mb-4">Fix the Caesar cipher decoder to reveal the hidden message.</p>
                <button onclick="toggleHint(4)" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-3">
                    🤔 Need Help? Click to show hint
                </button>
                <div id="hint-4" class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-3 hidden">
                    <p class="text-sm text-blue-800">📁 <strong>File to fix:</strong> <code class="bg-blue-100 px-2 py-1 rounded">app/Challenges/Level1/PHPLogicChallenge.php</code></p>
                    <p class="text-xs text-blue-600 mt-1">Look for: <code>obfuscatedCodeChallenge()</code> method</p>
                </div>
                
                <div class="bg-gray-100 p-4 rounded mb-4">
                    <code class="text-sm">
                        // Caesar cipher with shift 3<br>
                        if (ctype_lower($char)) {<br>
                        &nbsp;&nbsp;$result .= chr((ord($char) - ord('a') - 3 + 26) % 26 + ord('a'));<br>
                        } else {<br>
                        &nbsp;&nbsp;$result .= $char;<br>
                        }
                    </code>
                </div>

                <div class="space-y-3">
                    <input type="text" id="decodeInput" class="w-full border rounded px-3 py-2" 
                           placeholder="Enter encoded text" value="IODJ_1_GHFRGH">
                    <button onclick="testDecodeChallenge()" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Decode
                    </button>
                    <div id="decodeResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
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
</script>

<script>
function testArrayChallenge() {
    const input = document.getElementById('arrayInput').value;
    const numbers = input.split(',').map(n => parseInt(n.trim())).filter(n => !isNaN(n));
    
    axios.post('/level1/array', { numbers: numbers })
        .then(response => {
            const result = document.getElementById('arrayResult');
            result.innerHTML = `
                <div><strong>Result:</strong> ${response.data.result}</div>
                <div><strong>Hint:</strong> ${response.data.hint}</div>
            `;
            
            if (response.data.result.includes('FLAG_1_')) {
                result.classList.add('flag-found', 'text-green-600');
                showNotification('Flag found in array challenge!', 'success');
                // Automatically update progress
                submitFlag(1, response.data.result);
            }
        })
        .catch(error => {
            document.getElementById('arrayResult').innerHTML = 'Error: ' + error.message;
        });
}

function testStringChallenge() {
    const input = document.getElementById('stringInput').value;
    
    axios.post('/level1/string', { input: input })
        .then(response => {
            const result = document.getElementById('stringResult');
            result.innerHTML = `
                <div><strong>Result:</strong> ${response.data.result}</div>
                <div><strong>Hint:</strong> ${response.data.hint}</div>
            `;
            
            if (response.data.result.includes('FLAG_1_')) {
                result.classList.add('flag-found', 'text-green-600');
                showNotification('Flag found in string challenge!', 'success');
                // Automatically update progress
                submitFlag(2, response.data.result);
            }
        })
        .catch(error => {
            document.getElementById('stringResult').innerHTML = 'Error: ' + error.message;
        });
}

function testFactorialChallenge() {
    const n = parseInt(document.getElementById('factorialN').value);
    const answer = parseInt(document.getElementById('factorialAnswer').value);
    
    axios.post('/level1/factorial', { n: n, answer: answer })
        .then(response => {
            const result = document.getElementById('factorialResult');
            result.innerHTML = `<div><strong>Result:</strong> ${response.data.result}</div>`;
            
            if (response.data.result.includes('FLAG_1_')) {
                result.classList.add('flag-found', 'text-green-600');
                showNotification('Flag found in factorial challenge!', 'success');
                // Automatically update progress
                submitFlag(3, response.data.result);
            }
        })
        .catch(error => {
            document.getElementById('factorialResult').innerHTML = 'Error: ' + error.message;
        });
}

function testDecodeChallenge() {
    const input = document.getElementById('decodeInput').value;
    
    axios.post('/level1/decode', { input: input })
        .then(response => {
            const result = document.getElementById('decodeResult');
            result.innerHTML = `
                <div><strong>Result:</strong> ${response.data.result}</div>
                <div><strong>Hint:</strong> ${response.data.hint}</div>
            `;
            
            if (response.data.result.includes('FLAG_1_')) {
                result.classList.add('flag-found', 'text-green-600');
                showNotification('Flag found in decode challenge!', 'success');
                // Automatically update progress
                submitFlag(4, response.data.result);
            }
        })
        .catch(error => {
            document.getElementById('decodeResult').innerHTML = 'Error: ' + error.message;
        });
}

</script>
@endsection