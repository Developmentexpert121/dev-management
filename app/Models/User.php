<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_role',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function  isAdmin()
    {
        
        if($this->user_role == 5)
        { 
            return true; 
        } 
        else 
        { 
    
            return false; 
        }

        
    } 

    public function  isTeamLeader()
    {
        if($this->user_role == 1)
        { 
            
            return true; 
        } 
        else 
        { 
            return false; 
        }
    }

    public function  isEmployee()
    {
        if($this->user_role == 2)
        { 
            return true; 
        } 
        else 
        { 
            return false; 
        }
    }

    public function  isManager()
    {
        if($this->user_role == 3)
        { 
            return true; 
        } 
        else 
        { 
            return false; 
        }
    }

    public function  isHr()
    {
        if($this->user_role == 4)
        { 
            return true; 
        } 
        else 
        { 
            return false; 
        }

    }



    
    
}
