<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectComment extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'comment'
    ];
    
	/**
	 * The project to which the comment belongs.
	 */
	public function project()
	{
		return $this->belongsTo('App\Project');
	}

    /**
     * The user that posted the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
