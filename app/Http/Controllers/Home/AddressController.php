<?php /** @noinspection PhpUndefinedFieldInspection */
/** @noinspection PhpUndefinedMethodInspection */

/** @noinspection UnknownColumnInspection */

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use App\Models\UserAddress;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $addresses  = UserAddress::query()->where('user_id',auth()->id())->get();
        $provinces  = Province::all();

        return view('home.users_profile.addresses',[
            'provinces'     =>      $provinces,
            'addresses'     =>      $addresses
        ]);
    }


    /**
     * @param Request $request
     * @return Collection|array
     */
    public function getProvinceCitiesList(Request $request): \Illuminate\Database\Eloquent\Collection|array
    {

        return City::query()->where('province_id',$request->province_id)->get();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validateWithBag('addressesStore',[
            'title'         =>  'required|min:3|max:100|persian_alpha|unique:user_addresses,title',
            'cellphone'     =>  'required|ir_mobile',
            'address'       =>  'required|persian_alpha',
            'postal_code'   =>  'required|ir_postal_code',
            'province_id'   =>  'required|integer',
            'city_id'       =>  'required|integer',
        ]);

        UserAddress::query()->create([
            'user_id'       =>  auth()->id(),
            'title'         =>  $request->input('title'),
            'cellphone'     =>  $request->input('cellphone'),
            'address'       =>  $request->input('address'),
            'postal_code'   =>  $request->input('postal_code'),
            'province_id'   =>  $request->input('province_id'),
            'city_id'       =>  $request->input('city_id'),
        ]);

        Alert::success(__('Confirm'),__('Your address has been saved correctly'));
        return redirect()->back();

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param UserAddress $address
     * @return RedirectResponse
     */
    public function update(Request $request, UserAddress $address): RedirectResponse
    {
        $validator = Validator::make($request->all(),[
            'title'         =>  'required|min:3|max:100|persian_alpha',
            'cellphone'     =>  'required|ir_mobile',
            'address'       =>  'required|persian_alpha',
            'postal_code'   =>  'required|ir_postal_code',
            'province_id'   =>  'required|integer',
            'city_id'       =>  'required|integer',
        ]);

        if($validator->fails())
        {
            $validator->errors()->add('address_id', $address->id);
            return redirect()->back()->withErrors($validator, 'addressesUpdate')->withInput();
        }

        $address->update([
            'user_id'       =>  auth()->id(),
            'title'         =>  $request->input('title'),
            'cellphone'     =>  $request->input('cellphone'),
            'address'       =>  $request->input('address'),
            'postal_code'   =>  $request->input('postal_code'),
            'province_id'   =>  $request->input('province_id'),
            'city_id'       =>  $request->input('city_id'),
        ]);

        Alert::success(__('Confirm'),__('Your address has been updated correctly'));
        return redirect()->back();
    }
}
