<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permission';

    public $timestamp = true;

    protected $guarded = [];


    public function permissionChildent()
    {
        return $this->hasMany('App\Model\Permission','id_parent','id');
    }
}
