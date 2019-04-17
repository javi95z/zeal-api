<?php

namespace App;

use Auth;
use Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
	use SoftDeletes;

	/**
	 * @var array
	 */
	protected $fillable = [
		'code',
		'title',
		'description',
		'status',
		'priority',
		'start_date',
		'end_date',
		'type'
	];

	/**
	 * Executed when loading model
	 */
	public static function boot()
	{
		parent::boot();
		Project::updated(function($user) {
			$log = new ActivityLog;
			$log->user_id   		= Auth::id() ? Auth::id() : '1';
			$log->description		= 'projectupdated;' . $user->id;
			$log->ip_address		= Request::ip();
			$log->save();  // Insert the new log
		});
		Project::created(function($user) {
			$log = new ActivityLog;
			$log->user_id   		= Auth::id() ? Auth::id() : '1';
			$log->description		= 'projectcreated;' . $user->id;
			$log->ip_address		= Request::ip();
			$log->save();  // Insert the new log
		});
		Project::deleted(function($user) {
			$log = new ActivityLog;
			$log->user_id   		= Auth::id() ? Auth::id() : '1';
			$log->description		= 'projectdeleted;' . $user->id;
			$log->ip_address		= Request::ip();
			$log->save();  // Insert the new log
		});
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function contacts()
	{
		return $this->belongsToMany('App\Contact');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function comments()
	{
		return $this->hasMany('App\ProjectComment');
	}

	/**
	 * The tasks that belong to the project.
	 */
	public function tasks()
	{
		return $this->hasMany('App\Task');
	}

}
