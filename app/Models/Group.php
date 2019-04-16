<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'discount'
    ];
}
