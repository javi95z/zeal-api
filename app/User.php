<?php

namespace App;

use App\Notifications\AddedToProject;
use Auth;
use Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;
	use SoftDeletes;

    /**
     * @var array
     */
	protected $fillable = [
		'type',
		'fullname',
		'email',
		'password',
		'address',
		'state',
		'city',
		'country',
		'suffix',
		'gender',
		'phone_number',
		'skype',
		'website',
		'profile_picture',
		'background_picture',
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
			$log = new ActivityLog;
            $log->user_id   		= Auth::id() ? Auth::id() : '1';
            $log->description		= 'employeeupdated;' . $user->id;
			$log->ip_address		= Request::ip();
			$log->save();  // Insert the new log
		});

		User::created(function($user) {
			$log = new ActivityLog;
			$log->user_id   		= Auth::id() ? Auth::id() : '1';
			$log->description		= 'employeecreated;' . $user->id;
			$log->ip_address		= Request::ip();
			$log->save();  // Insert the new log
		});

		User::deleted(function($user) {
			$log = new ActivityLog;
            $log->user_id   		= Auth::id() ? Auth::id() : '1';
            $log->description		= 'employeedeleted;' . $user->id;
			$log->ip_address		= Request::ip();
			$log->save();  // Insert the new log
		});
	}

    /**
     * @param $query
     * @return mixed
     */
    public function scopeEmployees($query)
    {
        return $query->where('type', 'employee');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeClients($query)
    {
        return $query->where('type', 'client');
    }

	/**
	 * The positions that belong to the user.
	 */
	public function positions()
	{
		return $this->belongsToMany('App\Position');
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
