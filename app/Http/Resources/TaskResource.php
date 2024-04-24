<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Task */
class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image_path' => $this->image_path,
            'status' => $this->status,
            'priority' => $this->priority,
            'due_date' => $this->due_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'assigned_user_id' => $this->assigned_user_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'project_id' => $this->project_id,
            'project' => new ProjectResource($this->whenLoaded('project')),
        ];
    }
}
