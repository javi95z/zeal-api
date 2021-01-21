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
		'project_id',
		'user_id'
	];

	/**
     * The project of the task.
	 */
	public function project()
	{
		return $this->belongsTo('App\Project');
	}

	/**
     * The user owner of the task.
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

    /**
     * The reports of the task.
     */
    public function reports()
    {
        return $this->hasMany('App\TaskReport')->orderBy('created_at', 'desc')->with('user:name');
    }

}
