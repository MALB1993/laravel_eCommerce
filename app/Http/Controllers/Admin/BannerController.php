<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::latest()->paginate(5, ['*'], __('banners'));
        return view('admin.banners.index',[
            'banners'   =>  $banners
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'         =>  'required|mimes:jpg,jpeg,png,svg,webp',
            'title'         =>  'nullable|string|unique:banners,title|min:3|max:100',
            'text'          =>  'nullable|string|max:1000',
            'priority'      =>  'nullable|integer',
            'is_active'     =>  'required|boolean',
            'type'          =>  'required|string',
            'button_text'   =>  'nullable|string',
            'button_link'   =>  'nullable|string',
            'button_icon'   =>  'nullable|string'
        ]);

        $uploadBanner = new ProductImageController();
        $fileNameImage = $uploadBanner->uploadBanner($request->image);

        Banner::create([
            'image'        =>   $fileNameImage['fileNameBanner'],
            'title'        =>   $request->input('title'),
            'text'         =>   $request->input('text'),
            'priority'     =>   $request->input('priority'),
            'is_active'    =>   $request->input('is_active'),
            'type'         =>   $request->input('type'),
            'button_text'  =>   $request->input('button_text'),
            'button_link'  =>   $request->input('button_link'),
            'button_icon'  =>   $request->input('button_icon'),
        ]);

        Alert::toast(__('create banner successfully !'),'success');
        return redirect()->route('admin-panel.banners.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        return view('admin.banners.show',['banner' => $banner]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit',['banner' => $banner]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {

        $request->validate([
            'image'         =>      'nullable|mimes:jpg,jpeg,png,svg,webp',
            'title'         =>      'nullable|string|min:3|max:100|unique:banners,title,'.$banner->id,
            'text'          =>      'nullable|string|max:1000',
            'priority'      =>      'nullable|integer',
            'is_active'     =>      'required|boolean',
            'type'          =>      'required|string',
            'button_text'   =>      'nullable|string',
            'button_link'   =>      'nullable|string',
            'button_icon'   =>      'nullable|string'
        ]);

        if($request->has('image'))
        {
            $uploadBanner = new ProductImageController();
            $fileNameImage = $uploadBanner->uploadBanner($request->image);
        }

        $banner->image          =   $request->has('image') ? $fileNameImage['fileNameBanner'] : $banner->image;
        $banner->title          =   $request->input('title');
        $banner->text           =   $request->input('text');
        $banner->priority       =   $request->input('priority');
        $banner->is_active      =   $request->input('is_active');
        $banner->type           =   $request->input('type');
        $banner->button_text    =   $request->input('button_text');
        $banner->button_link    =   $request->input('button_link');
        $banner->button_icon    =   $request->input('button_icon');


        $banner->update();
        Alert::toast(__('edit banner successfully !'),'success');
        return redirect()->route('admin-panel.banners.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        //
    }
}
