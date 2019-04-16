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
	
}
