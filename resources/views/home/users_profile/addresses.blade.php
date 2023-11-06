@extends('home.layouts.home')

@section('title')
    صفحه ای آدرس ها
@endsection

@section('script')
    <script>
        $('.province-select').change(function() {

            var provinceID = $(this).val();

            if (provinceID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-province-cities-list') }}?province_id=" + provinceID,
                    success: function(res) {
                        if (res) {
                            $(".city-select").empty();

                            $.each(res, function(key, city) {
                                console.log(city);
                                $(".city-select").append('<option value="' + city.id + '">' +
                                    city.name + '</option>');
                            });

                        } else {
                            $(".city-select").empty();
                        }
                    }
                });
            } else {
                $(".city-select").empty();
            }
        });

    </script>
@endsection

@section('content')

    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{ route('home.index') }}">صفحه ای اصلی</a>
                    </li>
                    <li class="active"> آدرس ها </li>
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
                                @include('home.sections.profile_sidebar')
                            </div>
                            <!-- My Account Tab Menu End -->
                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">

                                    <div class="myaccount-content address-content">
                                        <h3> آدرس ها </h3>

                                        @foreach ($addresses as $address)
                                            <div>
                                                <address>
                                                    <p>
                                                        <strong>
                                                            {{ auth()->user()->name == null ? 'کاربرگرامی' : auth()->user()->name }}
                                                        </strong>
                                                        <span class="mr-2"> عنوان آدرس : <span> {{ $address->title }}
                                                            </span> </span>
                                                    </p>
                                                    <p>
                                                        {{ $address->address }}
                                                        <br>
                                                        <span> استان : {{ province_name($address->province_id) }} </span>
                                                        <span> شهر : {{ city_name($address->city_id) }} </span>
                                                    </p>
                                                    <p>
                                                        کدپستی :
                                                        {{ $address->postal_code }}
                                                    </p>
                                                    <p>
                                                        شماره موبایل :
                                                        {{ $address->cellphone }}
                                                    </p>

                                                </address>
                                                <a data-toggle="collapse" href="#collapse-address-{{ $address->id }}"
                                                    class="check-btn sqr-btn">
                                                    <i class="sli sli-pencil"></i>
                                                    ویرایش آدرس
                                                </a>

                                                <div id="collapse-address-{{ $address->id }}" class="collapse"
                                                    style="{{ count($errors->addressUpdate) > 0 && $errors->addressUpdate->first('address_id') == $address->id ? 'display:block' : '' }}">
                                                    <form
                                                        action="{{ route('home.addresses.update', ['address' => $address->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="row">

                                                            <div class="tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    عنوان
                                                                </label>
                                                                <input type="text" name="title"
                                                                    value="{{ $address->title }}">
                                                                @error('title', 'addressUpdate')
                                                                    <p class="input-error-validation">
                                                                        <strong>{{ $message }}</strong>
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                            <div class="tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    شماره تماس
                                                                </label>
                                                                <input type="text" name="cellphone"
                                                                    value="{{ $address->cellphone }}">
                                                                @error('cellphone', 'addressUpdate')
                                                                    <p class="input-error-validation">
                                                                        <strong>{{ $message }}</strong>
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                            <div class="tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    استان
                                                                </label>
                                                                <select class="email s-email s-wid province-select"
                                                                    name="province_id">
                                                                    @foreach ($provinces as $province)
                                                                        <option value="{{ $province->id }}"
                                                                            {{ $province->id == $address->province_id ? 'selected' : '' }}>
                                                                            {{ $province->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('province_id', 'addressStore')
                                                                    <p class="input-error-validation">
                                                                        <strong>{{ $message }}</strong>
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                            <div class="tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    شهر
                                                                </label>
                                                                <select class="email s-email s-wid city-select"
                                                                    name="city_id">
                                                                    <option value="{{ $address->city_id }}" selected>
                                                                        {{ city_name($address->city_id) }}
                                                                    </option>
                                                                </select>
                                                                @error('city_id', 'addressStore')
                                                                    <p class="input-error-validation">
                                                                        <strong>{{ $message }}</strong>
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                            <div class="tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    آدرس
                                                                </label>
                                                                <input type="text" name="address"
                                                                    value="{{ $address->address }}">
                                                                @error('address', 'addressUpdate')
                                                                    <p class="input-error-validation">
                                                                        <strong>{{ $message }}</strong>
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                            <div class="tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    کد پستی
                                                                </label>
                                                                <input type="text" name="postal_code"
                                                                    value="{{ $address->postal_code }}">
                                                                @error('postal_code', 'addressUpdate')
                                                                    <p class="input-error-validation">
                                                                        <strong>{{ $message }}</strong>
                                                                    </p>
                                                                @enderror
                                                            </div>

                                                            <div class=" col-lg-12 col-md-12">

                                                                <button class="cart-btn-2" type="submit"> ثبت آدرس
                                                                </button>
                                                            </div>

                                                        </div>

                                                    </form>

                                                </div>

                                            </div>

                                            <hr>
                                        @endforeach

                                        <button class="collapse-address-create mt-3" type="submit"> ایجاد آدرس
                                            جدید </button>
                                        <div class="collapse-address-create-content"
                                            style="{{ count($errors->addressStore) > 0 ? 'display:block' : '' }}">

                                            <form action="{{ route('home.addresses.store') }}" method="POST">
                                                @csrf
                                                <div class="row">

                                                    <div class="tax-select col-lg-6 col-md-6">
                                                        <label>
                                                            عنوان
                                                        </label>
                                                        <input type="text" name="title" value="{{ old('title') }}">
                                                        @error('title', 'addressStore')
                                                            <p class="input-error-validation">
                                                                <strong>{{ $message }}</strong>
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="tax-select col-lg-6 col-md-6">
                                                        <label>
                                                            شماره تماس
                                                        </label>
                                                        <input type="text" name="cellphone" value="{{ old('cellphone') }}">
                                                        @error('cellphone', 'addressStore')
                                                            <p class="input-error-validation">
                                                                <strong>{{ $message }}</strong>
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="tax-select col-lg-6 col-md-6">
                                                        <label>
                                                            استان
                                                        </label>
                                                        <select class="email s-email s-wid province-select"
                                                            name="province_id">
                                                            @foreach ($provinces as $province)
                                                                <option value="{{ $province->id }}">{{ $province->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('province_id', 'addressStore')
                                                            <p class="input-error-validation">
                                                                <strong>{{ $message }}</strong>
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="tax-select col-lg-6 col-md-6">
                                                        <label>
                                                            شهر
                                                        </label>
                                                        <select class="email s-email s-wid city-select" name="city_id">
                                                        </select>
                                                        @error('city_id', 'addressStore')
                                                            <p class="input-error-validation">
                                                                <strong>{{ $message }}</strong>
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="tax-select col-lg-6 col-md-6">
                                                        <label>
                                                            آدرس
                                                        </label>
                                                        <input type="text" name="address" value="{{ old('address') }}">
                                                        @error('address', 'addressStore')
                                                            <p class="input-error-validation">
                                                                <strong>{{ $message }}</strong>
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="tax-select col-lg-6 col-md-6">
                                                        <label>
                                                            کد پستی
                                                        </label>
                                                        <input type="text" name="postal_code"
                                                            value="{{ old('postal_code') }}">
                                                        @error('postal_code', 'addressStore')
                                                            <p class="input-error-validation">
                                                                <strong>{{ $message }}</strong>
                                                            </p>
                                                        @enderror
                                                    </div>

                                                    <div class=" col-lg-12 col-md-12">

                                                        <button class="cart-btn-2" type="submit"> ثبت آدرس
                                                        </button>
                                                    </div>



                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->

@endsection
