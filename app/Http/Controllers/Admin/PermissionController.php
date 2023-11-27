<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::latest()->paginate(10,['*'],'Permissions');
        return view('admin.permissions.index',[
            'permissions'   =>  $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          =>  'required|string',
            'display_name'  =>  'required|string',
        ]);

        Permission::create([
            'name'          =>  $request->input('name'),
            'display_name'  =>  $request->input('display_name'),
            'guard_name'    =>  'web'
        ]);

        Alert::success(__('Confirm'),__('Create Permission successfully !'));
        return redirect()->route('admin-panel.permissions.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit',['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name'          =>  'required|string',
            'display_name'  =>  'required|string',
            'guard_name'    =>  'web'
        ]);

        $permission->update([
            'name'          =>  $request->input('name'),
            'display_name'  =>  $request->input('display_name'),
        ]);

        Alert::success(__('Confirm'),__('Edit Permission successfully !'));
        return redirect()->route('admin-panel.permissions.index');
    }
}
