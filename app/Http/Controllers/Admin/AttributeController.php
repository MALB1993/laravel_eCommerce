<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = Attribute::latest()->paginate(5, ['*'], __('attribute'));
        return view('admin.attributes.index',[
            'attributes'    =>  $attributes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.attributes.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  =>  ['required', 'min:1', "max:20", "string", "unique:attributes,name"]
        ]);

        Attribute::create([
            'name'  =>  $request->input('name')
        ]);

        Alert::toast(__('create attributes successfully !'), 'success');

        return redirect()->route('admin-panel.attributes.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Attribute $attribute)
    {
        return view('admin.attributes.show',['attribute' => $attribute]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute $attribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attribute $attribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        //
    }
}
