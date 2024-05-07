<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user', 'comments')->withCount('comments')->get();
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $request->validated($request->all());

        $imagePath = Storage::disk('public')->put('post_images', $request->image);

        return new PostResource(Post::Create([
            'caption' => $request->caption,
            'user_id' => auth()->user()->id,
            'image_path' => $imagePath
        ]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = Post::where('id', $post->id)->with('comments')->withcount('comments')->first();
        return new PostResource($post);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
    }
}
