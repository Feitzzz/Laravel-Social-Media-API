<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
                'username' => $this->username,
                'avatarPath' => asset($this->avatar_path) === "/" ? null : asset($this->avatar_path),
            ];
    }
}
