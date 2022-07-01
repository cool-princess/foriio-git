<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens; 

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasApiTokens;
    protected $table="users";
    protected $guard  = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'password', 
        'company', 
        'person', 
        'email', 
        'doc', 
        'doc_url', 
        'release_url', 
        'status',
        'pwd_store',
        'break'
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
        'admin_id_verified_at' => 'datetime',
    ];
}
