<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        return [
            'id' => (string) $this->id,
            'content' => $this->content,
            'userId' => (string) $this->user_id,
            'postId' => (string) $this->post_id,
            'username' => $this->user->username,
        ];
    }
}
