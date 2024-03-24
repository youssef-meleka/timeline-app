<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Stories
Route::post('/stories', [StoryController::class, 'addStory']);
Route::get('/users/{userId}/stories', [StoryController::class, 'listUserStories']);
Route::get('/top-posts', [StoryController::class, 'listTopStories']);

// Reviews
Route::post('/stories/{storyId}/reviews', [ReviewController::class, 'addReview']);

// Users
Route::get('/users/{userId}', [UserController::class, 'getUser']);
