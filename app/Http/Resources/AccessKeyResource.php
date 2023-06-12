<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccessKeyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'key' => $this->key,
            'expired_at' => $this->expired_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'created_at'=>$this->created_at
        ];
    }
}
