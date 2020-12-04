<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'date',
        'invested_hours',
        'comment'
    ];

    /**
     * The task of the comment.
     */
    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    /**
     * The user owner of the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
