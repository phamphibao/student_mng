<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    
    use Notifiable;
    protected $table = 'users';
    public $timestamp = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','image','birth_day','gender','class_id', 'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $attributes = [
        'password' => '$2y$10$M9dqSjhCZNrXj25rVRiDVu2DDbw3sqoOYeghZP/UV4O77hhEuW4kO', //123456789
    ];



    /**
     * The roles that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\model\Roles', 'users_roles', 'user_id', 'roles_id');
    }

    /**
     * Get the classes associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function classes()
    {
        return $this->hasOne('App\Model\Classes', 'teacher_id', 'id');
    }

    /**
     * Get the ClassOfstudent that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ClassStudent()
    {
        return $this->belongsTo('App\Model\Classes', 'class_id');
    }

    public function checkPermission($key)
    {
        $user = Auth::user();
        $roles = $user->roles;
       
        foreach ($roles as $role) {
            $permission = $role->permission;
            if ($permission->contains('key',$key)) {
                return true;
            }else{
                return false;
            }
        }
      
    }
}
