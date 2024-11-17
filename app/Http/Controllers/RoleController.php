<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Helpers\LogHelper;

class RoleController extends Controller
{
    public function index()
    {
      
        $roles = Role::with('permissions')->paginate(5);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

        public function store(Request $request)
        {
            
             // Validate input data
            // Validate input data
            $request->validate([
                'name' => 'required|unique:roles,name',
                'permissions' => 'required|array|min:1',  // At least one permission is required
                'permissions.*' => 'exists:permissions,id', // Ensure each permission ID exists
            ]);


                // Ensure at least one permission is selected if permissions are provided
                if ($request->has('permissions') && count($request->permissions) < 1) {
                    return redirect()->back()->withInput()->withErrors(['permissions' => 'At least one permission must be selected.']);
                }

                 // Create the new role
    $role = Role::create(['name' => $request->name]);

              // If permissions are provided, give the role those permissions
    if ($request->has('permissions') && is_array($request->permissions) && count($request->permissions) > 0) {
        // Ensure we only pass a valid array of permission names
        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
      
        $role->givePermissionTo($permissions);
        // Log the role assignment
        
        // Now, log each permission change (added or removed)
        foreach ($permissions as $permissionName) {
            $permission = Permission::findByName($permissionName);
            $description = "Permission '{$permissionName}' synced for role '{$role->name}'";
            LogHelper::logAuditEvent('role created_with_permissions', $description, $role);
        }

    }

    // Redirect to roles index with a success message
    return redirect()->route('roles.index')->with('success', 'Role created successfully.');

        }

    public function edit(Role $role)
    {
     
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
      
        
         // Validate input data
         $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required|array|min:1',  // At least one permission is required
            'permissions.*' => 'exists:permissions,id', // Ensure each permission ID exists
        ]);


        $role->update(['name' => $request->name]);
      

    $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
    
    $role->givePermissionTo($permissions);
        //$role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
