<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Project
 * @package App\Http\Resources
 *
 * @property int id
 * @property string code
 * @property object contact
 * @property string description
 * @property string end_date
 * @property string name
 * @property string priority
 * @property string start_date
 * @property string status
 * @property array tasks
 * @property string title
 * @property array users
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 */
class Project extends JsonResource
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
            'code' => $this->code,
            'contact' => $this->whenLoaded('contact'),
            'description' => $this->description,
            'end_date' => $this->end_date,
            'name' => $this->name,
            'priority' => $this->priority,
            'start_date' => $this->start_date,
            'status' => $this->status,
            'users' => $this->whenLoaded('users'),
            'tasks' => $this->whenLoaded('tasks'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
