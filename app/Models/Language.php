<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'abbreviation'
    ];
}
