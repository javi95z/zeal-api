<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
	use SoftDeletes;

	/**
	 * @var array
	 */
	protected $fillable = [
		'email',
		'active',
		'name',
		'suffix',
		'gender',
		'profile_img',
		'background_img',
		'is_admin'
	];

	/**
	 * @var array
	 */
	protected $hidden = [
		'pivot',
		'password',
		'api_token',
		'remember_token',
		'role_id',
		'settings_id'
	];

	/**
	 * Executed when loading model
	 */
	public static function boot()
	{
		parent::boot();

		User::updated(function ($user) {
			// $log = new ActivityLog;
			// $log->user_id   		= Auth::id() ? Auth::id() : '1';
			// $log->description		= 'userupdated;' . $user->id;
			// $log->ip_address		= Request::ip();
			// $log->save();  // Insert the new log
		});

		User::created(function ($user) {
			// $log = new ActivityLog;
			// $log->user_id   		= Auth::id() ? Auth::id() : '1';
			// $log->description		= 'usercreated;' . $user->id;
			// $log->ip_address		= Request::ip();
			// $log->save();  // Insert the new log
		});

		User::deleted(function ($user) {
			// $log = new ActivityLog;
			// $log->user_id   		= Auth::id() ? Auth::id() : '1';
			// $log->description		= 'userdeleted;' . $user->id;
			// $log->ip_address		= Request::ip();
			// $log->save();  // Insert the new log
		});
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function role()
	{
		return $this->belongsTo('App\Role');
	}

	/**
	 * The settings configuration of the user.
	 */
	public function settings()
	{
		return $this->belongsTo('App\Setting');
	}

	/**
	 * The teams to which the user belongs.
	 */
	public function teams()
	{
		return $this->belongsToMany('App\Team');
	}

	/**
	 * The projects that belong to the user.
	 */
	public function projects()
	{
		return $this->belongsToMany('App\Project');
	}

	/**
	 * The tasks the user owns.
	 */
	public function tasks()
	{
		return $this->hasMany('App\Task');
	}

    /**
     * The comments created by the user.
     */
	public function task_comments()
    {
        return $this->belongsToMany('App\TaskComment');
    }

	/**
	 * Get the identifier that will be stored in the subject claim of the JWT.
	 *
	 * @return mixed
	 */
	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Return a key value array, containing any custom claims to be added to the JWT.
	 *
	 * @return array
	 */
	public function getJWTCustomClaims()
	{
		return [];
	}
}
