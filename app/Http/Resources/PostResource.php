<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use \App\Http\Resources\CommentResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        return[
            'id' => (string) $this->id,
            'caption' => $this->caption,
            'userId' => (string) $this->user_id,
            'username' => $this->user->username,
            'comments' => CommentResource::collection($this->comments),
            'numberOfComments' => (string) $this->comments_count,
            'imagePath' => asset($this->image_path) === "/" ? null : asset($this->image_path),
            'createdAt' => $this->created_at->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
