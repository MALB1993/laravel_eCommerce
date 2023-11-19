@extends('home.layouts.master')
@section('title',__('Address'))
@section('content')
<div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{ route('home.index') }}">{{ __('Original') }}</a>
                </li>
                <li class="active">{{ __('profile') }}</li>
            </ul>
        </div>
    </div>
</div>

<!-- my account wrapper start -->
<div class="my-account-wrapper pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row text-right" style="direction: rtl;">
                        <div class="col-lg-3 col-md-4">
                            @include('home.sections.sidebar')
                        </div>
                        <!-- My Account Tab Menu End -->

                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8">
                            <div class="myaccount-content address-content">
                                <h3> آدرس ها </h3>
                                <p><strong>{{ auth()->user()->name == null ? __('Client') : auth()->user()->name }}</strong></p>
                                @foreach ($addresses as $address)
                                    <div>
                                        <address>
                                            <p>
                                                <span class="mr-2"> عنوان آدرس : <span> {{ $address->title }} </span> </span>
                                            </p>
                                            <p>
                                                {{ $address->address }}
                                                <br>
                                                <span>
                                                    {{ __('State') }} : 
                                                    {{ province_name($address->province_id) }} 
                                                </span>
                                                -
                                                <span>
                                                    {{ __('City') }} : 
                                                    {{ city_name($address->city_id) }} 
                                                </span>
                                            </p>
                                            <p class="d-flex justify-content-between">
                                                <span>{{ __('Postal Code') }} : </span>
                                                <span>{{ $address->postal_code }}</span>
                                            </p>
                                            <p class="d-flex justify-content-between">
                                                <span>{{ __('Phone Number') }} : </span>
                                                <span>{{ $address->cellphone }}</span>
                                            </p>
                                
                                        </address>
                                        <a data-toggle="collapse" href="#collapse-address-update-content-{{ $address->id }}" class="check-btn sqr-btn collapse-address-update">
                                            <i class="sli sli-pencil"></i>
                                            {{ __('Edit') }} {{ __('Address') }}
                                        </a>
                                        <div class="collapse border p-2 border-secondary rounded-md m-1" id="collapse-address-update-content-{{ $address->id }}" style="{{ count($errors->addressesUpdate) > 0 && $errors->addressesUpdate->first('address_id') == $address->id ? 'display:block' : '' }}">
                                
                                        <form action="{{ route('home.user-profile.address.update', ['address' => $address->id]) }}" method="post">    
                                            @csrf
                                            @method('PUT')
                                
                                            <div class="row">
                                                {{-- title --}}
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    {{-- title --}}
                                                    <label for="title">{{ __('Title') }}</label>
                                                    <input type="text" name="title" id="title" value="{{ $address->title }}" dir="auto"> 
                                                    @error('title','addressesUpdate')
                                                        <div class="input-error-validation">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                                {{-- cellphone --}}
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label for="cellphone">{{ __('Phone Number') }}</label>
                                                    <input type="text" name="cellphone" value="{{ $address->cellphone }}" dir="ltr">
                                                    @error('cellphone','addressesUpdate')
                                                        <div class="input-error-validation">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>

                                                {{-- province --}}
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label for="province">استان</label>
                                                    <select name="province_id" id="province" class="province-select">
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->id }}" {{ $province->id == $address->province_id ? 'selected' : '' }} >{{ $province->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('province_id','addressesUpdate')
                                                        <div class="input-error-validation">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                                {{-- city --}}
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label for="city">شهر</label>
                                                    <select id="city" name="city_id" class="city-select">
                                                        <option value="{{ $address->id }}" selected >{{ city_name($address->id) }}</option>
                                                    </select>
                                                    @error('city_id','addressesUpdate')
                                                        <div class="input-error-validation">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                                
                                                {{-- address --}}
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label for="address">آدرس</label>
                                                    <input type="text" name="address" id="address" value="{{ $address->address }}">
                                                    @error('address','addressesUpdate')
                                                        <div class="input-error-validation">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                                {{-- postal code --}}
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label for="postal_code">کد پستی</label>
                                                    <input type="text" name="postal_code" value="{{ $address->postal_code }}" dir="ltr"> 
                                                    @error('postal_code','addressesUpdate')
                                                        <div class="input-error-validation">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class=" col-lg-12 col-md-12">
                                                    <button class="cart-btn-2" type="submit"> ثبت آدرس</button>
                                                </div>
                                            </div>
                                        </form>
                                
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                                <button class="collapse-address-create mt-3" type="submit"> ایجاد آدرس جدید </button>
                                <div class="collapse-address-create-content" style="{{ count($errors->addressesStore) > 0 ? 'display:block' : '' }}">
                            
                                    <form action="{{ route('home.user-profile.address.store') }}" method="post">
                                        @csrf
                                        @method('POST')
                            
                                        <div class="row">
                                            {{-- title --}}
                                            <div class="tax-select col-lg-6 col-md-6">
                                                {{-- title --}}
                                                <label for="title">{{ __('Title') }}</label>
                                                <input type="text" name="title" id="title" value="{{ old('title') }}" class="@error('title','addressesStore') is-invalid @enderror" dir="auto"> 
                                                @error('title','addressesStore')
                                                    <div class="input-error-validation">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                            {{-- cellphone --}}
                                            <div class="tax-select col-lg-6 col-md-6">
                                                <label for="cellphone">{{ __('Phone Number') }}</label>
                                                <input type="text" name="cellphone" value="{{ old('cellphone') }}" class="@error('cellphone','addressesStore') is-invalid @enderror" dir="ltr">
                                                @error('cellphone','addressesStore')
                                                    <div class="input-error-validation">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>

                                            {{-- province --}}
                                            <div class="tax-select col-lg-6 col-md-6">
                                                <label for="province">استان</label>
                                                <select name="province_id" id="province" class="province-select">
                                                    @foreach ($provinces as $province)
                                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('province_id','addressesStore')
                                                    <div class="input-error-validation">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                            {{-- city --}}
                                            <div class="tax-select col-lg-6 col-md-6">
                                                <label for="city">شهر</label>
                                                <select id="city" name="city_id" class="city-select"></select>
                                                @error('city_id','addressesStore')
                                                    <div class="input-error-validation">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                            
                                            {{-- address --}}
                                            <div class="tax-select col-lg-6 col-md-6">
                                                <label for="address">آدرس</label>
                                                <input type="text" name="address" id="address" value="{{ old('address') }}">
                                                @error('address','addressesStore')
                                                    <div class="input-error-validation">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                            {{-- postal code --}}
                                            <div class="tax-select col-lg-6 col-md-6">
                                                <label for="postal_code">کد پستی</label>
                                                <input type="text" name="postal_code" value="{{ old('postal_code') }}" dir="ltr"> 
                                                @error('postal_code','addressesStore')
                                                    <div class="input-error-validation">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class=" col-lg-12 col-md-12">
                                                <button class="cart-btn-2" type="submit"> ثبت آدرس</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- My Account Tab Content End -->
                    </div>
                </div> <!-- My Account Page End -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
    <script>

        $(".province-select").change(function(){

            const provinceID = $(this).val();
            
            if(provinceID)
            {
                $.ajax({
                    type    :   "GET",
                    url     :   "{{ url('profile/get-province-cities-list') }}?province_id="+provinceID,
                    success : function(res){
                        if(res)
                        {
                            $(".city-select").empty();
                            $.each(res, function(key, city){
                                $(".city-select").append(`<option value="${city.id}">${city.name}</option`);
                            });
                        }else{
                            $(".city-select").empty();
                        }
                    },

                });
            }
        });

    </script>
@endsection