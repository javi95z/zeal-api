<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Role
 * @package App\Http\Resources
 *
 * @property int id
 * @property string color
 * @property string description
 * @property string name
 */
class Role extends JsonResource
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
            'color' => $this->color,
            'description' => $this->description,
            'name' => $this->name
        ];
    }
}
