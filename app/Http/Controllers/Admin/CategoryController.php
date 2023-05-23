<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        #_______________________________________________ Get categories record
        $categories = Category::query()->latest()->paginate(5);

        #_______________________________________________ View return and pass categories to view
        return view(
            'Admin.Pages.Categories.index',
            compact([
                'categories'
            ])
        );
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        #_________________________ Get parent categories
        $parentCategories = Category::query()->where('parent_id', 'LIKE', 0)->get();

        #_________________________ Get Attributes
        $attributes = Attribute::query()->orderBy('id','desc')->get();

        return view('Admin.Pages.Categories.create', compact(['parentCategories', 'attributes']));
    }

    /**
     *Store a newly created resource in storage.
     * @param StoreCategoryRequest $storeCategoryRequest
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $storeCategoryRequest): RedirectResponse
    {


        #______________________________________ try and catch for create category and pivot table
        try {
            #_______________________ Start transaction database
            DB::beginTransaction();

            $category = Category::query()->create([
                'parent_id'     =>         $storeCategoryRequest->input('parent_id'),
                'name'          =>         $storeCategoryRequest->input('name'),
                'slug'          =>         $storeCategoryRequest->input('slug'),
                'is_active'     =>         $storeCategoryRequest->input('is_active'),
                'description'   =>         $storeCategoryRequest->input('description'),
                'icon'          =>         $storeCategoryRequest->input('icon'),
            ]);

            foreach ($storeCategoryRequest->input('attribute_ids') as $attributeId) {
                $attribute =  Attribute::query()->findOrFail($attributeId);

                $attribute->categories()->attach($category->id, [
                    'is_filter'     =>      in_array($attributeId, $storeCategoryRequest->input('attribute_is_filter_ids')) ? 1 : 0,
                    'is_variation'  =>      $storeCategoryRequest->input('variation_id') === $attributeId ? 1 : 0,
                ]);
            }

            DB::commit();
            #_______________________ End transaction database

        } catch (\Exception $exception) {
            DB::rollBack();
        #_________________________________________ variables
        $message = 'مشکل در ذخیره دسته بندی ها به وجود آمده است .';

        #_________________________________________ Sweet Alert
        alert()->error($message, $exception->getMessage())->persistent('متوجه شدم');

        #_________________________________________ pass message and redirect
        return redirect()->back();

        }

        #_________________________________________[ if every thing passed ]

        #_________________________________________ variables
        $message = 'دسته بندی شما به درستی ذخیره شد';

        #_________________________________________ Sweet Alert
        alert()->success('گزارش وضعیت', $message);

        #_________________________________________ pass message and redirect
        return redirect()->route('admin.categories.index');
    }

    /**
     **Display the specified resource.
     * @param Category $category
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public function show(Category $category): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('Admin.Pages.Categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {

        #_________________________ Get parent categories
        $parentCategories = Category::query()->where('parent_id', 'LIKE', 0)->get();

        #_________________________ Get Attributes
        $attributes = Attribute::query()->orderBy('id','desc')->get();

        return view('Admin.Pages.Categories.edit',compact(['category', 'parentCategories', 'attributes']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
