<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes';

    public $timestamp = true;

    protected $fillable = ['name','teacher_id'];


    /**
     * Get the teacher that owns the Classes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher()
    {
        return $this->belongsTo('App\Model\User', 'teacher_id', 'id');
    }

    /**
     * Get all of the students for the Classes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany('App\Model\User', 'class_id', 'id');
    }
}