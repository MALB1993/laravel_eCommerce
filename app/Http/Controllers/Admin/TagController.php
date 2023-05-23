<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        #__________________________________________________ Get Tags
        $tags = Tag::query()->latest()->paginate(5);

        #__________________________________________________ return view and pass tags to view
        return view('Admin.Pages.Tags.index',compact(['tags']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('Admin.Pages.Tags.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreTagRequest $storeTagRequest
     * @return RedirectResponse
     */
    public function store(StoreTagRequest $storeTagRequest): RedirectResponse
    {
        #_________________________________________ variables
        $message = 'تگ شما به درستی ذخیره شد .';

        #_________________________________________ created brand
        Tag::query()->create([
            'name'          =>      $storeTagRequest->input('name'),
            'is_active'     =>      $storeTagRequest->input('is_active'),
            'created_at'    =>      Carbon::now(),
            'updated_at'    =>      null,
        ]);

        #_________________________________________ Sweet Alert
        alert()->success('گزارش وضعیت',$message);


        #_________________________________________ pass message and redirect
        return redirect()->route('admin.tags.index');
    }

    /**
     * Display the specified resource.
     * @param Tag $tag
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public function show(Tag $tag): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('Admin.Pages.tags.show', compact(['tag']));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Tag $tag
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public function edit(Tag $tag): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('Admin.Pages.tags.edit', compact(['tag']));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateTagRequest $updateTagRequest
     * @param Tag $tag
     * @return RedirectResponse
     */
    public function update(UpdateTagRequest $updateTagRequest, Tag $tag): RedirectResponse
    {
        #_________________________________________ variables
        $message = 'تگ شما به درستی ویرایش شد .';

        #_________________________________________ created brand
        $tag->update([
            'name'          =>      $updateTagRequest->input('name'),
            'is_active'     =>      $updateTagRequest->input('is_active'),
            'updated_at'    =>      Carbon::now(),
        ]);

        #_________________________________________ Sweet Alert
        alert()->success('گزارش وضعیت',$message);


        #_________________________________________ pass message and redirect
        return redirect()->route('admin.tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        #_________________________________________ variables
        $message = 'تگ شما به درستی حذف شد .';

        #_________________________________________ Sweet Alert
        alert()->success('گزارش وضعیت',$message);

        #________________________________________ Deleted item
        $tag->delete();

        #_________________________________________ pass message and redirect
        return redirect()->route('admin.tags.index');
    }
}
