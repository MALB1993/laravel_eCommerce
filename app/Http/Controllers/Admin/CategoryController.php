<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(5, ['*'], __('Categories'));
        return view('admin.categories.index',[
            'categories'    =>  $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories =   Category::query()->where('parent_id',0)->orderBy("name","desc")->get();
        $attributes     =   Attribute::all();
        return view('admin.categories.create',[
            'parentCategories'    =>  $parentCategories,
            'attributes'        =>  $attributes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'name'                      =>    'required|min:3|max:200|string',
            'slug'                      =>    'required|min:3|max:200|unique:categories,slug',
            'parent_id'                 =>    'required|integer',
            'attribute_ids'             =>    'required',
            'attribute_is_filter_ids'   =>    'required',
            'is_variation'              =>    'required',
            'icon'                      =>    'nullable',
            'description'               =>    'nullable',
            'is_active'                 =>    'required|boolean'
        ]);


        try {

            \Illuminate\Support\Facades\DB::beginTransaction();

            $category =  Category::query()->create([
                'name'          =>  $request->input('name'),
                'slug'          =>  $request->input('slug'),
                'parent_id'     =>  $request->input('parent_id'),
                'icon'          =>  $request->input('icon'),
                'description'   =>  $request->input('description'),
            ]);

            foreach($request->attribute_ids as $attributeId){
                $attribute = Attribute::query()->findOrFail($attributeId);
                $attribute->categories()->attach($category->id, [
                    'is_filter'     =>  in_array($attributeId, $request->attribute_is_filter_ids) ? 1 : 0,
                    'is_variation'  =>  $request->is_variation == $attributeId ? 1 : 0,
                    'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s')
                ]);
            }

            \Illuminate\Support\Facades\DB::commit();

        } catch (\Exception $ex) {
           \Illuminate\Support\Facades\DB::rollBack();
            Alert::toast(__('Difficulty creating categories') . $ex->getCode() , 'danger');
            return redirect()->back();
        }

        Alert::toast(__('create categories successfully !'), 'success');
        return redirect()->route('admin-panel.categories.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show',[
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $parentCategories   =   Category::query()->where('parent_id',0)->orderBy("name","desc")->get();
        $attributes         =   Attribute::all();

        return view('admin.categories.edit',[
            'category'          =>  $category,
            'attributes'        =>  $attributes,
            'parentCategories'  =>  $parentCategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'                      =>    'required|min:3|max:200|string',
            'slug'                      =>    'required|min:3|max:200|unique:categories,slug,'.$category->id,
            'parent_id'                 =>    'required|integer',
            'attribute_ids'             =>    'required',
            'attribute_is_filter_ids'   =>    'required',
            'is_variation'              =>    'required',
            'icon'                      =>    'nullable',
            'description'               =>    'nullable',
            'is_active'                 =>    'required|boolean'
        ]);


        try {

            \Illuminate\Support\Facades\DB::beginTransaction();

            $category->update([
                'name'          =>  $request->input('name'),
                'slug'          =>  $request->input('slug'),
                'parent_id'     =>  $request->input('parent_id'),
                'icon'          =>  $request->input('icon'),
                'description'   =>  $request->input('description'),
            ]);
            $category->attributes()->detach();
            foreach($request->attribute_ids as $attributeId){
                $attribute = Attribute::query()->findOrFail($attributeId);
                $attribute->categories()->attach($category->id, [
                    'is_filter'     =>  in_array($attributeId, $request->attribute_is_filter_ids) ? 1 : 0,
                    'is_variation'  =>  $request->is_variation == $attributeId ? 1 : 0,
                    'created_at'    =>  Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'    =>  Carbon::now()->format('Y-m-d H:i:s')
                ]);
            }

            \Illuminate\Support\Facades\DB::commit();

        } catch (\Exception $ex) {
           \Illuminate\Support\Facades\DB::rollBack();
            Alert::toast(__('Difficulty update categories') . $ex->getCode() , 'danger');
            return redirect()->back();
        }

        Alert::toast(__('edit categories successfully !'), 'success');
        return redirect()->route('admin-panel.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }



    /**
     * Summary of getCategoryAttribute
     * @param \App\Models\Category $category
     * @return array
     */
    public function getCategoryAttribute(Category $category)
    {
        $attributes = $category->attributes()->wherePivot('is_variation',0)->get();
        $variations = $category->attributes()->wherePivot('is_variation',1)->first();

        return [
            'attributes'    =>      $attributes,
            'variations'    =>      $variations
        ];
    }

}
