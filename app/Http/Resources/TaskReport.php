<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class TaskReport
 * @package App\Http\Resources
 *
 * @property int id
 * @property int user_id
 * @property int task_id
 * @property string comment
 * @property double invested_hours
 * @property object user
 * @property object task
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 */
class TaskReport extends JsonResource
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
            'user_id' => $this->user_id,
            'task_id' => $this->task_id,
            'comment' => $this->comment,
            'invested_hours' => $this->invested_hours,
            'user' => $this->whenLoaded('user'),
            'task' => $this->whenLoaded('task'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
