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
                           placeholder="Enter string to decode" value="GNIDOC_1_GALF_3_2_1">
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
                           placeholder="Enter encoded text" value="iodj_ghfrgh_iodj">
                    <button onclick="testDecodeChallenge()" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Decode
                    </button>
                    <div id="decodeResult" class="bg-gray-100 p-3 rounded min-h-[60px] font-mono text-sm"></div>
                </div>
            </div>
        </div>

        <!-- Flag Submission -->
        <div class="mt-8 border-t pt-6">
            <h3 class="text-xl font-semibold mb-4">Submit Flags</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <input type="text" id="flagInput" class="w-full border rounded px-3 py-2" 
                           placeholder="Enter your flag (e.g., FLAG_1_...)">
                    <button onclick="submitFlag(1, document.getElementById('flagInput').value)" 
                            class="mt-2 w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Submit Flag
                    </button>
                </div>
                <div class="bg-yellow-50 border border-yellow-200 rounded p-4">
                    <p class="text-sm text-yellow-800">
                        <strong>Hint:</strong> Flags will appear in the challenge results when you solve them correctly!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

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
            }
        })
        .catch(error => {
            document.getElementById('decodeResult').innerHTML = 'Error: ' + error.message;
        });
}
</script>
@endsection