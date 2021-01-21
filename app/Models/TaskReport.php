<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskReport extends Model
{
	/**
	 * @var array
	 */
	protected $fillable = [
		'name',
		'user_id',
		'task_id',
		'description',
		'invested_hours',
		'comment',
    ];

	/**
     * The task of the report.
	 */
	public function task()
	{
		return $this->belongsTo('App\Task');
	}

	/**
     * The user of the report.
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
