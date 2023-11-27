<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Premission;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PremissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.premissions.create');
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


        Premission::create([
            'name'          =>  $request->input('name'),
            'display_name'  =>  $request->input('display_name'),
            'guard_name'    =>  'web',
        ]);

        Alert::success(__('Confirm'),__('Create Premission successfully !'));
        return redirect()->route('admin-panel.premissions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Premission $premission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Premission $premission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Premission $premission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Premission $premission)
    {
        //
    }
}
