<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'faculty';

    public $timestamp = true;

    protected $fillable = ['name','phone','email','dean_id'];


    /**
     * Get the teacher that owns the Classes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dean()
    {
        return $this->belongsTo('App\Model\User', 'dean_id', 'id');
    }
}
