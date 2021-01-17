<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Task
 * @package App\Http\Resources
 *
 * @property int id
 * @property array comments
 * @property string description
 * @property string end_date
 * @property string name
 * @property string priority
 * @property object project
 * @property string start_date
 * @property string status
 * @property object user
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 */
class Task extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'end_date' => $this->end_date,
            'priority' => $this->priority,
            'start_date' => $this->start_date,
            'status' => $this->status,
            'estimated_hours' => $this->estimated_hours,
            'project' => $this->whenLoaded('project'),
            'user' => $this->whenLoaded('user'),
            'comments' => $this->whenLoaded('comments'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
