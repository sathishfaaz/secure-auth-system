<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Helpers\LogHelper;
use App\Models\AuditLog;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles') // Eager load roles to avoid N+1 query issue
        ->paginate(5); // Set pagination per page here
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
{
   
    // Validate the user input
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'roles' => 'required|array',
    ], [
        'name.required' => 'Please provide your name.',
        'email.required' => 'The email address is required.',
        // Add other custom messages if needed
    ]);
 

    // Create a new user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // Assign multiple roles to the user
    $user->assignRole($request->roles);  // $request->roles is an array

        // Log the role assignment
        LogHelper::logAuditEvent('role_assigned', "Role '{$role->name}' assigned to user '{$user->name}'", $user);


    return redirect()->route('users.index')->with('success', 'User created successfully.');
}

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'roles' => 'required|array',
        ]);
    
        // Update user details
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);
    
        // Sync the roles (this will overwrite existing roles)
        $user->syncRoles($request->roles);
    
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        //if ($user->can('delete articles')) {
            // Perform delete action
       
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    //}
    }

        // Toggle the user's active status
        public function toggleStatus(User $user)
        {
            $user->is_active = !$user->is_active; // Toggle active status
            $user->save();

            return redirect()->route('users.index')->with('success', 'User status updated!');
        }

        public function editPermissions(User $user)
    {
        $permissions = Permission::all();
        return view('users.permissions', compact('user', 'permissions'));
    }

    public function assignPermissions(Request $request, User $user)
    {
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        // Sync user permissions
        $user->syncPermissions($request->permissions);


        // Now, log each permission change (added or removed)
        foreach ($request->permissions as $permissionName) {
            $permission = Permission::findByName($permissionName);
            $description = "Permission '{$permission->name}' synced for user '{$user->name}'";
            LogHelper::logAuditEvent('permission_synced', $description, $user);
        }


        return redirect()->route('users.index')
                         ->with('success', 'Permissions assigned successfully.');
    }

    public function showAuditLogs()
{
    $auditLogs = AuditLog::with('user')->latest()->get();
    return view('admin.audit-logs', compact('auditLogs'));
}
}

