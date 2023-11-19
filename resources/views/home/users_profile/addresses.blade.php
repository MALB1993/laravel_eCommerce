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
                            
                                <div>
                                    <address>
                                        <p>
                                            <strong> علی شیخ </strong>
                                            <span class="mr-2"> عنوان آدرس : <span> منزل </span> </span>
                                        </p>
                                        <p>
                                            خ شهید فلان ، کوچه ۸ فلان ،فرعی فلان ، پلاک فلان
                                            <br>
                                            <span> استان : تهران </span>
                                            <span> شهر : تهران </span>
                                        </p>
                                        <p>
                                            کدپستی :
                                            89561257
                                        </p>
                                        <p>
                                            شماره موبایل :
                                            89561257
                                        </p>
                            
                                    </address>
                                    <a href="#" class="check-btn sqr-btn collapse-address-update">
                                        <i class="sli sli-pencil"></i>
                                        ویرایش آدرس
                                    </a>
                            
                                    <div class="collapse-address-update-content">
                            
                                        <form action="#">
                            
                                            <div class="row">
                            
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        عنوان
                                                    </label>
                                                    <input type="text" required="" name="title">
                                                </div>
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        شماره تماس
                                                    </label>
                                                    <input type="text">
                                                </div>
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        استان
                                                    </label>
                                                    <select class="email s-email s-wid">
                                                        <option>Bangladesh</option>
                                                        <option>Albania</option>
                                                        <option>Åland Islands</option>
                                                        <option>Afghanistan</option>
                                                        <option>Belgium</option>
                                                    </select>
                                                </div>
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        شهر
                                                    </label>
                                                    <select class="email s-email s-wid">
                                                        <option>Bangladesh</option>
                                                        <option>Albania</option>
                                                        <option>Åland Islands</option>
                                                        <option>Afghanistan</option>
                                                        <option>Belgium</option>
                                                    </select>
                                                </div>
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        آدرس
                                                    </label>
                                                    <input type="text">
                                                </div>
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        کد پستی
                                                    </label>
                                                    <input type="text">
                                                </div>
                            
                                                <div class=" col-lg-12 col-md-12">
                                                    <button class="cart-btn-2" type="submit"> ویرایش آدرس</button>
                                                </div>
                            
                                            </div>
                            
                                        </form>
                            
                                    </div>
                            
                                </div>
                            
                                <hr>
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