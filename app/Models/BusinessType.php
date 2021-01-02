<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'name_plural'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }
}
