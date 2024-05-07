<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Post;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Post $post, StoreCommentRequest $request)
    {
        $request->validated($request->all());
        return new CommentResource(Comment::create([
            'content' => $request->content,
            'post_id' => $post->id,
            'user_id' => auth()->user()->id
        ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
    }
}
