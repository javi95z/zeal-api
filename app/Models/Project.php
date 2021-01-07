<?php

namespace App;

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
		'name',
		'description',
		'status',
		'priority',
		'start_date',
		'end_date'
	];

	/**
	 * @var array
	 */
	protected $hidden = [
		'pivot'
	];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function contact()
	{
		return $this->belongsTo('App\Contact');
	}

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function tasks()
	{
		return $this->hasMany('App\Task');
	}

}
