<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostLikeController extends Controller
{
    public function like(Post $post)
    {
        $liker = auth()->user();

        if ($liker->likes()->where('post_id', $post->id)->exists()) {
            return response([
                'message' => 'You have already liked this post'
            ], 409);
        }

        $liker->likes()->attach($post->id);

        return response([
            'message' => 'Post Liked'
        ], 201);
    }

    public function unlike(Post $post)
    {
        $liker = auth()->user();

        $liker->likes()->detach($post->id);

        return response([
            'message' => 'Like Removed'
        ], 201);
    }
}
