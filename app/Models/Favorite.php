<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'item_id',
        'item_type'
    ];

	/**
	 * The user the favorite belongs to.
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
