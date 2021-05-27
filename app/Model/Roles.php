<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Classes;
use App\Model\User;
class Roles extends Model
{
    protected $table = 'roles';

    public $timestamp = true;

    protected $fillable = ['name','detail'];

    public function permission()
    {
        return $this->belongsToMany('App\Model\Permission','roles_permission','roles_id','permission_id');
    }


    public function users()
    {
        return $this->belongsToMany('App\Model\User','users_roles','roles_id','user_id');
    }
    
    
}
