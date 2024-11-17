<?php

// app/Http/Controllers/AuditLogController.php
namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    /**
     * Display a listing of the audit logs.
     *
     * @return \Illuminate\View\View
     */
   
        // app/Http/Controllers/AuditLogController.php
        public function index(Request $request)
        {
            $query = AuditLog::with('user')->orderBy('created_at', 'desc');
            
            if ($request->has('search') && !empty($request->search)) {
                $searchTerm = $request->input('search');
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('event', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
                });
            }

            $auditLogs = $query->paginate(5);

            return view('admin.audit-log.index', compact('auditLogs'));
        }

}
