<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Story;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class StoryController extends Controller
{
    /**
     * Add a new story.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addStory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $story = new Story([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => 1, // Replace with authenticated user ID
        ]);
        $story->save();

        return response()->json($story, 201);
    }

    /**
     * List user posts with pagination.
     *
     * @param Request $request
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function listUserStories(Request $request, $userId)
    {
        $validator = Validator::make(['user_id' => $userId], [
            'user_id' => 'required|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $perPage = $request->has('per_page') ? min($request->per_page, 50) : 10; // Limit per page to 50 for efficiency
        $page = $request->has('page') ? max(1, $request->page) : 1;

        $stories = Story::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($stories, 200);
    }

    /**
     * List top posts with pagination (optimized for performance).
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listTopStories(Request $request)
    {
        $perPage = $request->has('per_page') ? min($request->per_page, 50) : 10; // Limit per page to 50 for efficiency
        $page = $request->has('page') ? max(1, $request->page) : 1;

        $topPosts = DB::table('stories')
            ->select('stories.*', DB::raw('AVG(reviews.rating) AS average_rating'))
            ->leftJoin('reviews', function ($join) {
                $join->on('stories.id', '=', 'reviews.story_id');
            })
            ->groupBy('stories.id')
            ->orderBy('average_rating', 'desc')
            ->orderBy('stories.created_at', 'desc') // Secondary sort for tiebreakers
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($topPosts, 200);
    }

}
