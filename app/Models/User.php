<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'role_id',
        'first_name',
        'last_name',
        'postal_code',
        'country',
        'state',
        'city',
        'contact',
        'postal_address',
        'permenant_address',
        'delievery_type',
        'packaging_type',
        'preferred_delivery_window',
        'email',
        'password',
        'remember_token'

=======
        'name',
        'email',
        'password',
>>>>>>> 59a7ac583698c39cbe5f6ab079fc8665b979e88d
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
