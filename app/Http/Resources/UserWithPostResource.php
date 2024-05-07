<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserWithPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return [
        //     'id' => $this->id,
        //     'name' => $this->name,
        //     // other user fields...
        //     'posts_count' => $this->posts_count,
        //     'posts' => $this->posts->map(function ($post) {
        //         return [
        //             'id' => $post->id,
        //             'title' => $post->title,
        //             // other post fields...
        //             'comments_count' => $post->comments_count,
        //             'comments' => $post->comments->map(function ($comment) {
        //                 return [
        //                     'id' => $comment->id,
        //                     'content' => $comment->content,
        //                     // other comment fields...
        //                 ];
        //             }),
        //         ];
        //     }),
        // ];

        return [
            'id' => $this->id,
            'username' => $this->username,
            'avatarPath' => asset($this->avatar_path) === "/" ? null : asset($this->avatar_path),
            'posts' => $this->posts->map(function ($post) {
                return [
                    'post' => new PostResource($post),
                ];
            }),
        ];
    }
}
