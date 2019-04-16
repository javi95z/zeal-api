<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{	
    /**
     * @var array
     */
	protected $fillable = [
		'name',
		'description',
		'color'
	];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
