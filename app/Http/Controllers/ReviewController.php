<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Add a review to a post.
     *
     * @param Request $request
     * @param int $storyId
     * @return \Illuminate\Http\JsonResponse
     */
    public function addReview(Request $request, $storyId)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Check if story exists
        $story = Story::find($storyId);
        if (!$story) {
            return response()->json(['error' => 'Story not found'], 404);
        }

        // Create and save the review
        $review = new Review([
            'rating' => $request->rating,
            'comment' => $request->comment,
            'story_id' => $storyId,
            // Replace with authenticated user ID if needed
            'user_id' => 1, // Temporary value, replace with authenticated user
        ]);
        $review->save();

        return response()->json($review, 201);
    }
}

