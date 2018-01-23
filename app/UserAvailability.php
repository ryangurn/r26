<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAvailability extends Model
{
    protected $table = 'users_availability';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'day', 'start_time', 'end_time'
    ];

    /**
     * @var array
     *
     * Validator rules for creation and updating
     */
    public $CRU_validator = [
        'user_id' => 'required|exists:users,id',
        'day' => 'required|numeric',
        'start_time' => 'required',
        'end_time' => 'required',
    ];

    public $D_validator = [
        'delete_id' => 'required|integer|exists:users_availability,id'
    ];
}
