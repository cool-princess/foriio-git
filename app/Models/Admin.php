<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table="admin";
    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'password', 
        'company_name',
        'furi_company_name',
        'department_name',
        'job_title', 
        'name', 
        'furi_name', 
        'email', 
        'phone',
        'zipcode',
        'address1',
        'address2',
        'address3',
        'address4',
        'sectors',
        'break',
        'pwd_store',
        'download_count'
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
        'user_id_verified_at' => 'datetime',
    ];
}
