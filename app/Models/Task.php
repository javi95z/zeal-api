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
		'name',
		'description',
		'status',
		'priority',
		'start_date',
		'end_date',
		'project_id'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function project()
	{
		return $this->belongsTo('App\Project');
	}

    /**
     * The comments of the task.
     */
    public function comments()
    {
        return $this->belongsToMany('App\TaskComment');
    }

}
