<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RefferenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "role_id" => $this->role_id,
            "user_id" => $this->user_id,
            "role" => $this->whenLoaded("role"),
            "user" => $this->whenLoaded("user"),
        ];
    }
}
