<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
	use SoftDeletes;

    /**
     * The project to which the task belongs.
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    // TODO: Función getStatusColor() como en Ticket
}
