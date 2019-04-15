<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{	
    /**
     * @var array
     */
	protected $fillable = [
		'title', 'description', 'color'
	];
	
	/**
	 * The employees that belong to the position.
	 */
	public function employees()
	{
		return $this->belongsToMany('App\User');
	}
}
