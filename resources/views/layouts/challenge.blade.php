<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Challenge')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <style>
        .flag-found {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { background-color: rgb(34 197 94); }
            50% { background-color: rgb(74 222 128); }
            100% { background-color: rgb(34 197 94); }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <h1 class="text-xl font-bold">Laravel Developer Challenge</h1>
                </div>
                <div class="flex space-x-4">
                    <a href="/" class="hover:bg-blue-700 px-3 py-2 rounded">Home</a>
                    <a href="/dashboard" class="hover:bg-blue-700 px-3 py-2 rounded">Dashboard</a>
                    <a href="/progress" class="hover:bg-blue-700 px-3 py-2 rounded">Progress</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        @yield('content')
    </div>

    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>Laravel Developer Challenge - Test Your Skills</p>
            <p class="text-sm text-gray-400 mt-2">
                Created by <a href="https://github.com/mirzaaghazadeh" target="_blank" class="text-blue-400 hover:text-blue-300">Navid Mirzaaghazadeh</a>
            </p>
        </div>
    </footer>

    <script>
        // Convert global challenge ID to level-specific format
        function getChallengeInfo(challengeId) {
            let level, localChallenge;
            
            if (challengeId <= 4) {
                level = 1;
                localChallenge = challengeId;
            } else if (challengeId <= 10) {
                level = 2;
                localChallenge = challengeId - 4;
            } else {
                level = 3;
                localChallenge = challengeId - 10;
            }
            
            return { level, localChallenge };
        }
        
        // Global flag submission handler
        function submitFlag(challengeId, flag, callback) {
            const { level, localChallenge } = getChallengeInfo(challengeId);
            
            axios.post('/level' + level + '/submit-flag', {
                challenge_id: challengeId,
                flag: flag
            })
            .then(response => {
                if (callback) callback(response.data);
                else {
                    if (response.data.success) {
                        showNotification(`✅ Level ${level} - Challenge ${localChallenge} completed!`, 'success');
                        console.log('Progress updated:', response.data);
                    } else {
                        showNotification('Incorrect flag. Keep trying!', 'error');
                    }
                }
            })
            .catch(error => {
                console.error('Flag submission error:', error);
                if (callback) callback({ success: false, message: 'Error submitting flag' });
                else {
                    showNotification('Error submitting flag', 'error');
                }
            });
        }

        // Global notification system
        function showNotification(message, type = 'info') {
            const colors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                info: 'bg-blue-500',
                warning: 'bg-yellow-500'
            };

            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Toggle hint visibility
        function toggleHint(challengeId) {
            const hintElement = document.getElementById('hint-' + challengeId);
            if (hintElement) {
                hintElement.classList.toggle('hidden');
                
                // Track hint usage
                if (!hintElement.classList.contains('hidden')) {
                    axios.post('/api/progress/hint', {
                        challenge_id: challengeId
                    }).catch(error => {
                        console.error('Error tracking hint:', error);
                    });
                }
            }
        }
    </script>
</body>
</html>