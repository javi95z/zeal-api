<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class User
 * @package App\Http\Resources
 *
 * @property int id
 * @property bool active
 * @property string background_img
 * @property string email
 * @property string name
 * @property string gender
 * @property bool is_admin
 * @property string password
 * @property array projects
 * @property string profile_img
 * @property object role
 * @property string suffix
 * @property array teams
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 */
class User extends JsonResource
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
            'active' => $this->active,
            'email' => $this->email,
            'gender' => $this->gender,
            'is_admin' => $this->is_admin,
            'name' => $this->name,
            'role' => $this->whenLoaded('role'),
            'teams' => $this->whenLoaded('teams'),
            'projects' => $this->whenLoaded('projects'),
            'password' => $this->when(auth()->user()->is_admin, $this->password),
            'suffix' => $this->suffix,
            'profile_img' => $this->profile_img,
            'background_img' => $this->background_img,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
