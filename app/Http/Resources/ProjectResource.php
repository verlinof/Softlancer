<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            "project_title" => $this->project_title,
            "project_description" => $this->project_description,
            "project_qualification" => $this->project_qualification,
            "project_skill" => $this->project_skill,
            "job_type" => $this->job_type,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "status" => $this->status,
            "project_role" => $this->whenLoaded("projectRole"),
            "company" => $this->whenLoaded("company"),
            "role" => $this->whenLoaded("role"),
        ];
    }
}
