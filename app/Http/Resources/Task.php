<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Task
 * @package App\Http\Resources
 *
 * @property int id
 * @property string name
 * @property string description
 * @property string priority
 * @property string status
 * @property string start_date
 * @property string end_date
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
            'project' => $this->whenLoaded('project'),
            'user' => $this->whenLoaded('user'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
