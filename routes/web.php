<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Challenges\ChallengeController;
use App\Http\Controllers\Challenges\Level1Controller;
use App\Http\Controllers\Challenges\Level2Controller;
use App\Http\Controllers\Challenges\Level3Controller;

// Main challenge routes
Route::get('/', [ChallengeController::class, 'index']);
Route::get('/challenges', [ChallengeController::class, 'index']);
Route::get('/dashboard', [ChallengeController::class, 'dashboard']);
Route::get('/progress', [ChallengeController::class, 'progress']);

// Level 1 Routes - PHP Logic & Debugging
Route::get('/level1', [Level1Controller::class, 'index']);
Route::post('/level1/array', [Level1Controller::class, 'arrayChallenge']);
Route::post('/level1/string', [Level1Controller::class, 'stringChallenge']);
Route::post('/level1/factorial', [Level1Controller::class, 'factorialChallenge']);
Route::post('/level1/decode', [Level1Controller::class, 'decodeChallenge']);
Route::post('/level1/submit-flag', [Level1Controller::class, 'submitFlag']);

// Level 2 Routes - Laravel API & Database
Route::get('/level2', [Level2Controller::class, 'index']);
Route::post('/level2/validation', [Level2Controller::class, 'validationChallenge']);
Route::get('/level2/database', [Level2Controller::class, 'databaseChallenge']);
Route::post('/level2/cache', [Level2Controller::class, 'cacheChallenge']);
Route::post('/level2/api-response', [Level2Controller::class, 'apiResponseChallenge']);
Route::get('/level2/relationship', [Level2Controller::class, 'relationshipChallenge']);
Route::post('/level2/middleware', [Level2Controller::class, 'middlewareChallenge']);
Route::post('/level2/submit-flag', [Level2Controller::class, 'submitFlag']);

// Level 3 Routes - Advanced Laravel & Testing
Route::get('/level3', [Level3Controller::class, 'index']);
Route::post('/level3/queue', [Level3Controller::class, 'queueChallenge']);
Route::post('/level3/event', [Level3Controller::class, 'eventChallenge']);
Route::post('/level3/collection', [Level3Controller::class, 'collectionChallenge']);
Route::get('/level3/service-container', [Level3Controller::class, 'serviceContainerChallenge']);
Route::post('/level3/testing', [Level3Controller::class, 'testingChallenge']);
Route::get('/level3/query-builder', [Level3Controller::class, 'queryBuilderChallenge']);
Route::post('/level3/middleware-pipeline', [Level3Controller::class, 'middlewarePipelineChallenge']);
Route::post('/level3/submit-flag', [Level3Controller::class, 'submitFlag']);

// Progress API routes
Route::get('/api/progress', [App\Http\Controllers\API\ProgressController::class, 'getProgress']);
Route::post('/api/progress/update', [App\Http\Controllers\API\ProgressController::class, 'updateProgress']);
Route::post('/api/progress/reset', [App\Http\Controllers\API\ProgressController::class, 'resetProgress']);
