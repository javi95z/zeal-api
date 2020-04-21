<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
	use SoftDeletes;

	/**
	 * @var array
	 */
	protected $fillable = [
		'code',
		'name',
		'description',
		'status',
		'priority',
		'start_date',
		'end_date',
		'user_id',
		'project_id'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function project()
	{
		return $this->belongsTo('App\Project');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
