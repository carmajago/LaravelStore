<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','photo','role_id','password'
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

    public function hasRoles(array $roles) {
        error_log($this->role);
        return in_array($this->role['name'], $roles);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin() {
        return $this->hasRoles(['admin']);
    }
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }
}