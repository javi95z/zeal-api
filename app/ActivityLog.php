<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{    
    protected $table = 'activity_logs';

    /**
	 * The user who created the activity log.
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
