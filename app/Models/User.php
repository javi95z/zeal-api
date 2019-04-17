<?php

namespace App;

use Auth;
use Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use SoftDeletes;
	
    /**
     * @var array
     */
    protected $fillable = [
        'email',
		'active',
		'first_name',
		'last_name',
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
		'password', 'remember_token',
	];

	/**
	 * Executed when loading model
	 */
	public static function boot()
	{
		parent::boot();

		User::updated(function($user) {
			// $log = new ActivityLog;
            // $log->user_id   		= Auth::id() ? Auth::id() : '1';
            // $log->description		= 'userupdated;' . $user->id;
			// $log->ip_address		= Request::ip();
			// $log->save();  // Insert the new log
		});

		User::created(function($user) {
			// $log = new ActivityLog;
			// $log->user_id   		= Auth::id() ? Auth::id() : '1';
			// $log->description		= 'usercreated;' . $user->id;
			// $log->ip_address		= Request::ip();
			// $log->save();  // Insert the new log
		});

		User::deleted(function($user) {
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
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
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
     * The tickets that belong to the user.
     */
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

}
