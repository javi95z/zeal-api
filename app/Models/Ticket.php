<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    /**
     * The user to which the ticket belongs.
     */
    public function client()
    {
        return $this->belongsTo('App\User');
    }

    public function getStatusColor()
    {
        switch ($this->status)
        {
            case 'open': return 'primary'; break;
            case 'closed': return 'success'; break;
            case 'canceled': return 'danger'; break;
            default: return 'primary'; break;
        }
    }
}
