<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class User
 * @package App\Http\Resources
 *
 * @property int id
 * @property string bio
 * @property double discount
 * @property string email
 * @property string fax
 * @property string mobile_phone
 * @property string name
 * @property string phone_number
 * @property string skype
 * @property string website
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 */
class Contact extends JsonResource
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
            'bio' => $this->bio,
            'discount' => $this->discount,
            'email' => $this->email,
            'fax' => $this->fax,
            'type' => $this->type,
            'mobile_phone' => $this->mobile_phone,
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'skype' => $this->skype,
            'website' => $this->website,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
