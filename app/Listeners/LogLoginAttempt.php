<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Helpers\LogHelper;

class LogLoginAttempt
{
    public function handle(Login $event)
    {
        // Log the login attempt
        LogHelper::logAuditEvent('user_login', "User {$event->user->name} logged in.", $event->user);
    }
}
