<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectRoleResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "project_id" => $this->project_id,
            "role_id" => $this->role_id,
            "accepted_person" => $this->accepted_person,
            "max_person" => $this->max_person,
            "project" => $this->whenLoaded("project"),
            "role" => $this->whenLoaded("role"),
        ];
    }
}
