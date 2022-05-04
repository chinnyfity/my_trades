<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Transaction extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $timestamps = false; // i dont want created_at and updated_at

    protected $fillable = [
        'status',
        'transaction_status',
        'transId',
        'trans_type',
        'expiry',
        'user',
        'coins',
        'sender_addr',
        'receiver_addr',
        'amt_usd',
        'decline_reason',
        'notes',
        'date_created',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];
}
