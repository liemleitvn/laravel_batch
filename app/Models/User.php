<?php

namespace App\Models;

use App\Services\Verification\VerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * Class User
 * @package App\Models
 * @property User name
 * @property User email
 * @property User address
 * @property User birthday
 * @property User last_login_ip
 * @property User provider
 * @property User provider_id
 * @property User avatar
 * @property User last_login_at
 * @property User type
 * @property User isAdmin
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'address',
        'birthday',
        'last_login_ip',
        'provider',
        'provider_id',
        'avatar',
        'last_login_at',
        'type'
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

    /**
     * @var array
     */
    protected $appends = ['isAdmin'];

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likesCounters ()
    {
        return $this->hasMany(LikesCounter::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Check user is admin
     *
     * @return bool
     */
    public function getisAdminAttribute() {
        return !! $this->type == 1;
    }

}
