<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,Hasroles, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'password_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'password_expires_at' => 'datetime',
    ];

    // Optionally, specify which fields should be logged
    protected static $logAttributes = ['name', 'email'];

    // Optionally, specify which fields should not be logged
    protected static $dontLogAttributes = ['password'];

    // You can also specify the custom log name (e.g., for login or custom events)
   // protected static $logName = 'user_activity';

     // Optionally, you can define custom log descriptions
     public function getActivitylogOptions(): LogOptions
     {
         return LogOptions::defaults()
             ->logOnly(['name', 'email'])  // Only log changes to the name and email
             ->useLogName('user_activity'); // Use a custom log name
     }
}
