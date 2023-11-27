<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', [
            'users' =>  $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::latest()->get();
        $permissions = Permission::latest()->get();
        return view('admin.users.edit', [
            'user'          =>      $user,
            'roles'         =>      $roles,
            'permissions'   =>      $permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {

            \Illuminate\Support\Facades\DB::beginTransaction();
            $user->update([
                'name'          =>  $request->input('name'),
                'email'         =>  $request->input('email'),
                'cellphone'     =>  $request->input('cellphone'),
            ]);

            $user->syncRoles($request->role);
            $permissions  = $request->except('_token', '_method' ,'name', 'cellphone','email','role');
            $user->syncPermissions($permissions);

            \Illuminate\Support\Facades\DB::commit();
        } catch (\Exception $ex) {
            \Illuminate\Support\Facades\DB::rollBack();
            Alert::toast(__('Difficulty creating roles') . $ex->getCode(), 'danger');
            return redirect()->back();
        }
        Alert::success(__('Confirm'), __('edit user successfully !'));
        return redirect()->route('admin-panel.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
