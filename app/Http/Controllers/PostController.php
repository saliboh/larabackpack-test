<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function addPost(SavePostRequest $request)
    {
        try {
            $post = Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => auth()->user()->id,
            ]);

            return response()->json(['post' => $post], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }
}
