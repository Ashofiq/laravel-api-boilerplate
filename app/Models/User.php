<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    const VENDOR = 'vendor';
    const ADMIN   = 'admin';
    const CUSTOMER = 'customer';

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    


    public function reg($data)
    {
        return static::create($data);
    }
    
    public function getAll()
    {
        return static::all();
    }


    public function findUser($id)
    {
        return static::find($id);
    }

    public function checkUserWithEmail($email)
    {
        $user = static::where('email', $email)->first();
        
        if($user === null){
            return true;
        }

        return false;
    }

    public function deleteUser($id)
    {
        return static::find($id)->delete();
    }

}
