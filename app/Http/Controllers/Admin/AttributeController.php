<?php /** @noinspection PhpUndefinedMethodInspection */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Application|Factory|View|FoundationApplication
     */
    public function index(): View|FoundationApplication|Factory|Application
    {
        $attributes = Attribute::latest()->paginate(5, ['*'], __('attribute'));
        return view('admin.attributes.index', [
            'attributes'    =>  $attributes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return View|FoundationApplication|Factory|Application
     */
    public function create(): View|FoundationApplication|Factory|Application
    {
        return view("admin.attributes.create");
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'  =>  ['required', 'min:1', "max:20", "string", "unique:attributes,name"]
        ]);

        Attribute::query()->create([
            'name'  =>  $request->input('name')
        ]);

        Alert::toast(__('create attributes successfully !'), 'success');

        return redirect()->route('admin-panel.attributes.index');
    }

    /**
     * Display the specified resource.
     * @param Attribute $attribute
     * @return Application|Factory|View|FoundationApplication
     */
    public function show(Attribute $attribute): View|FoundationApplication|Factory|Application
    {
        return view('admin.attributes.show', ['attribute' => $attribute]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Attribute $attribute
     * @return Application|Factory|View|FoundationApplication
     */
    public function edit(Attribute $attribute): View|FoundationApplication|Factory|Application
    {
        return view('admin.attributes.edit', ['attribute' => $attribute]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Attribute $attribute
     * @return RedirectResponse
     */
    public function update(Request $request, Attribute $attribute): RedirectResponse
    {
        $request->validate([
            'name'  =>  'required|min:1|max:20|string|'. Rule::unique('attributes','name')->ignore($attribute->id)
        ]);

        $attribute->update([
            'name'  =>  $request->input('name')
        ]);

        $attribute->update();

        Alert::toast(__('edit attributes successfully !'), 'success');

        return redirect()->route('admin-panel.attributes.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Attribute $attribute
     */
    public function destroy(Attribute $attribute)
    {
        //
    }
}
