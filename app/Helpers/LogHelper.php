<?php

namespace App\Helpers;

use App\Models\AuditLog;

class LogHelper
{
    public static function logAuditEvent($event, $description, $auditable = null)
    {
        // Create a new AuditLog entry
        $auditLog = new AuditLog();
        $auditLog->event = $event;
        $auditLog->description = $description;

        // If an auditable model is passed, set the polymorphic relationship
        if ($auditable) {
            $auditLog->auditable_type = get_class($auditable);  // Store the model's class name
            $auditLog->auditable_id = $auditable->id;           // Store the model's ID
        }

        // Log the user performing the action
        $auditLog->user_id = auth()->id();
        
        // Save the audit log entry
        $auditLog->save();
    }
}
