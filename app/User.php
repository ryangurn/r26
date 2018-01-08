<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * @var array
     *
     * Validator rules for creation and updating
     */
    public $CRU_validator = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',

    ];

    public $D_validator = [
        'user_id' => 'required|integer|exists:rounds,id'
    ];
}
