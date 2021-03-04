<?php

namespace ZigKart;

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
	 
	const ADMIN_TYPE = 'admin';
    
	
	
	public function isAdmin()    {        
		return $this->user_type === self::ADMIN_TYPE;    
	} 
	 
	 
	 
    protected $fillable = [
        'name', 'email', 'password', 'username', 'user_token', 'earnings', 'user_type', 'provider', 'provider_id', 'verified', 'user_subscr_type', 'user_subscr_price', 'user_subscr_date', 'user_subscr_causes',
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
	
	
	
	
}
