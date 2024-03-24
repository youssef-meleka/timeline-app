<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    //EXTRA FUNCTION
    /**
     * Get user information (placeholder for future needs).
     *
     * @param Request $request
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser(Request $request, $userId)
    {
        $validator = Validator::make(['user_id' => $userId], [
            'user_id' => 'required|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Return basic user information (replace with needed data)
        return response()->json([
            'id' => $user->id,
            'username' => $user->username,
        ], 200);
    }
}
