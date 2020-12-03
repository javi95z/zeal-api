<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Role as RoleResource;
use App\Http\Resources\TeamCollection as TeamCollection;

/**
 * Class User
 * @package App\Http\Resources
 *
 * @property int id
 * @property bool active
 * @property string email
 * @property string first_name
 * @property string gender
 * @property bool is_admin
 * @property string last_name
 * @property string password
 * @property RoleResource role
 * @property TeamCollection teams
 * @property string suffix
 * @property string profile_img
 * @property string background_img
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
            'first_name' => $this->first_name,
            'gender' => $this->gender,
            'is_admin' => $this->is_admin,
            'last_name' => $this->last_name,
            'role' => new RoleResource($this->whenLoaded('role')),
            'teams' => new TeamCollection($this->whenLoaded('teams')),
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
