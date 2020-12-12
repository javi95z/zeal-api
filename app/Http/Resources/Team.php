<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Team
 * @package App\Http\Resources
 *
 * @property int id
 * @property string background_img
 * @property string name
 * @property string description
 * @property string profile_img
 * @property array users
 */
class Team extends JsonResource
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
            'profile_img' => $this->profile_img,
            'background_img' => $this->background_img,
            'users' => $this->whenLoaded('users'),
        ];
    }
}
