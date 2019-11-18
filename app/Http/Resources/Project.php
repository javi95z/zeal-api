<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Contact as ContactResource;

/**
 * Class Project
 * @package App\Http\Resources
 *
 * @property int id
 * @property string name
 * @property string code
 * @property ContactResource contact
 * @property string description
 * @property string end_date
 * @property string name
 * @property string title
 * @property string priority
 * @property string start_date
 * @property string status
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
            'contact' => new ContactResource($this->whenLoaded('contact')),
            'description' => $this->description,
            'end_date' => $this->end_date,
            'name' => $this->name,
            'title' => $this->title,
            'priority' => $this->priority,
            'start_date' => $this->start_date,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
