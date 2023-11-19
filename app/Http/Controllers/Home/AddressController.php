<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses  = UserAddress::query()->where('user_id',auth()->id())->get();
        $provinces  = DB::select('select * from provinces');
        
        return view('home.users_profile.addresses',[
            'provinces'     =>      $provinces,
            'addresses'     =>      $addresses  
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getProvinceCitiesList(Request $request)
    {
        
        $cities = City::where('province_id',$request->province_id)->get();

        return $cities;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validateWithBag('addressesStore',[
            'title'         =>  'required|min:3|max:100|persian_alpha|unique:user_addresses,title',
            'cellphone'     =>  'required|ir_mobile',
            'address'       =>  'required|persian_alpha',
            'postal_code'   =>  'required|ir_postal_code',
            'province_id'   =>  'required|integer',
            'city_id'       =>  'required|integer',
        ]);

        UserAddress::create([
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
     * Display the specified resource.
     */
    public function show(UserAddress $userAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserAddress $userAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserAddress $userAddress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAddress $userAddress)
    {
        //
    }
}
