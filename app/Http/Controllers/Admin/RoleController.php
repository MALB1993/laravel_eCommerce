<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::latest()->paginate(10, ['*'], 'roles');
        return view('admin.roles.index', [
            'roles' =>  $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::latest()->get();
        return view('admin.roles.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            \Illuminate\Support\Facades\DB::beginTransaction();
            
            $request->validate([
                'name'          =>  'required|string',
                'display_name'  =>  'required|string',
            ]);

            $role = Role::create([
                'name'          =>  $request->input('name'),
                'display_name'  =>  $request->input('display_name'),
                'guard_name'    =>  'web'
            ]);

            $permissions  = $request->except('_token', '_method' ,'name', 'display_name');
            
            
            $role->givePermissionTo($permissions);

            \Illuminate\Support\Facades\DB::commit();

        }
        catch (\Exception $ex) {
            \Illuminate\Support\Facades\DB::rollBack();
            Alert::toast(__('Difficulty creating roles') . $ex->getCode(), 'danger');
            return redirect()->back();
        }
        Alert::success(__('Confirm'), __('Create role successfully !'));
        return redirect()->route('admin-panel.roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::latest()->get(); 
        return view('admin.roles.edit', ['permissions' => $permissions, 'role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        try {

            \Illuminate\Support\Facades\DB::beginTransaction();
            
            $request->validate([
                'name'          =>  'required|string',
                'display_name'  =>  'required|string',
            ]);

            $role->update([
                'name'          =>  $request->input('name'),
                'display_name'  =>  $request->input('display_name'),
                'guard_name'    =>  'web'
            ]);

            $permissions  = $request->except('_token', '_method' ,'name', 'display_name');
            
            
            $role->syncPermissions($permissions);

            \Illuminate\Support\Facades\DB::commit();

        }
        catch (\Exception $ex) {
            \Illuminate\Support\Facades\DB::rollBack();
            Alert::toast(__('Difficulty creating roles') . $ex->getCode(), 'danger');
            return redirect()->back();
        }
        Alert::success(__('Confirm'), __('Create role successfully !'));
        return redirect()->route('admin-panel.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
