<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
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
            "cv_file" => $this->cv_file,
            "portofolio" => $this->portofolio,
            "status" => $this->status,
            "user" => $this->whenLoaded("user"),
            "project" => $this->whenLoaded("project"),
            "project_role" => $this->whenLoaded("project_role"),
            "role" => $this->whenLoaded("role"),
        ];
    }
}
