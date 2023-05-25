@extends('Admin.partials.master')
@section('title')
    {{ __('ایجاد محصول جدید') }}
@endsection
@section('scripts')
    <script src="{{ asset('/admin/assets/CzMore/jquery.czMore-latest.js') }}"></script>
    <script>
        //__________________________________ brand Selected
        $('#BrandSelect').selectpicker({
            'title' : 'برند محصول را انتخاب کنید'
        });

        //__________________________________ Tags Selected
        $('#TagSelects').selectpicker({
            'title' : 'تگ های محصول را انتخاب کنید'
        });

        //__________________________________ Show file name
        $('#primary_image').change(function (){
            //---- get the file name
            let fileName = $(this).val();
            // replace The "Choose a file" label
            $(this).next(".custom-file-label").html(fileName);
        });
        $('#images').change(function (){
            //---- get the file name
            let fileName = $(this).val();
            // replace The "Choose a file" label
            $(this).next(".custom-file-label").html(fileName);
        });


        //__________________________________ Category Selected
        $('#categorySelect').selectpicker({
            'title' : 'دسته بندی محصول را انتخاب کنید'
        });

        $("#variationContainer").hide();

        $('#categorySelect').on('changed.bs.select', function (){
            let categoryId = $(this).val();

            $.get(`{{ url('/admin-panel/management/category-attributes/${categoryId}') }}`, function (response, status){
                if(status === 'success')
                {
                    $("#variationContainer").fadeIn();

                    $('#attributes').find('div').remove();

                    response.attributes.forEach( attribute => {
                        let attributeFormGroup =  $('<div/>', {
                            class : 'form-group col-md-3'
                        });

                        attributeFormGroup.append($('<label/>', {
                            for : attribute.name,
                            text : attribute.name
                        }));

                        attributeFormGroup.append($('<input/>', {
                            type : 'text',
                            class : 'form-control',
                            id : attribute.name,
                            name : `attribute_ids[${attribute.id}]`
                        }));

                        $('#attributes').append(attributeFormGroup);

                    });

                    $('#variationName').text(response.variation.name);

                }else{
                    alert('مشکلی پیش آمده است');
                }
            }).fail(function (){
                alert('مشکلی در دریافت لیست ویژگی ها');
            });
        });

        $("#czContainer").czMore();

    </script>
@endsection
@section('content')

<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-12 col-md-12 mb-4 bg-white my-4 p-4">
        <div class="mb-4">
            <h5 class="font-weight-bold">{{ __('ایجاد محصول') }}</h5>
        </div>
        <hr>
        @include('Admin.sections.errors')
        <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">

                {{-- product title --}}
                <div class="col-md-12">
                    <h6 class="font-weight-bold">
                        <i class="fas fa-store mx-2"></i>
                        {{__('اطلاعات محصول')}}
                    </h6>
                </div>
                {{-- End product title --}}

                {{-- brand Product   --}}
                <div class="col">
                    <label for="name">{{ __('نام محصول') }}</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('نام محصول را وارد کنید') }}" value="{{ old('name')}}" />
                </div>
                {{-- end Product   --}}

                {{-- Product brand_id --}}
                <div class="col-3">
                    <label for="BrandSelect">{{ __('برندها') }}</label>
                    <select class="selectpicker form-control bg-light" name="brand_id" id="BrandSelect" data-live-search="true">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- end Product brand_id --}}

                {{-- Product is active --}}
                <div class="col">
                    <label for="is_active">{{ __('وضعیت') }}</label>
                    <select name="is_active" id="is_active" class="form-control form-select">
                        <option disabled selected>{{ __('وضعیت نمایش تگ را مشخص کنید') }}</option>
                        <option value="1">فعال</option>
                        <option value="0">غیرفعال</option>
                    </select>
                </div>
                {{-- end Product is active --}}

                {{-- Product tag ids --}}
                <div class="col-3">
                    <label for="TagSelects">{{ __('تگ ها') }}</label>
                    <select class="selectpicker form-control bg-light" name="tag_ids[]" id="TagSelects" data-live-search="true" multiple="">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- end Product tag ids --}}

                {{-- description --}}
                <div class="col-md-12 my-2">
                    <label for="description">{{ __('توضیحات') }}</label>
                    <textarea name="description" id="description" cols="30" rows="3" class="form-control">{{ old('description') }}</textarea>
                </div>
                {{-- end description --}}

            </div>
            <hr class="my-4">
            <div class="row">
                {{-- product images --}}
                <div class="col-md-12">
                    <h6 class="font-weight-bold">
                        <i class="fas fa-image mx-2"></i>
                        {{__('تصاویر محصول')}}
                    </h6>
                </div>
                {{-- End Product images --}}

                {{-- Product image input --}}
                <div class="col-md-3">
                    <input type="file" name="primary_image" id="primary_image" class="custom-file-input" value="{{ old('primary_image')}}" />
                    <label for="primary_image" class="custom-file-label">{{ __('انتخاب تصویر') }}</label>
                </div>
                {{-- end Product image input --}}

                {{-- Product image input --}}
                <div class="col-md-3 mx-5">
                    <input type="file" name="images[]" id="images" class="custom-file-input" multiple="" value="{{ old('images')}}" />
                    <label for="images" class="custom-file-label">{{ __('انتخاب تصاویر') }}</label>
                </div>
                {{-- end Product image input --}}

            </div>
            <hr class="my-4">
            <div class="row">
                {{-- product and attributes --}}
                <div class="col-md-12">
                    <h6 class="font-weight-bold">
                        <i class="fa fa-fw fa-pen mx-2"></i>
                        {{__('دسته بندی و ویژگی ها')}}
                    </h6>
                </div>
                {{-- End Product images --}}
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            {{-- Product tag ids --}}
                            <div class="col-3">
                                <label for="categorySelect">{{ __('دسته بندی') }}</label>
                                <select class="selectpicker form-control bg-light" name="category_id" id="categorySelect" data-live-search="true">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" class="d-flex justify-content-center">
                                            {{ $category->name }} - {{ $category->parent->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- end Product tag ids --}}
                        </div>
                    </div>
                    <div class="row">
                        {{-- attributes container --}}
                        <div class="col-md-12 my-3" id="attributesContainer">
                            <div id="attributes" class="row d-flex justify-content-center">

                            </div>
                        </div>
                        {{-- End attributes container --}}
                    </div>
                </div>
            </div>
            <hr class="my-3">
            <div class="row">
                {{-- product and attributes --}}
                <div class="col-md-12" id="variationContainer">
                    <h6>
                        <i class="fa fa-fw fa-pen mx-2"></i>
                        <span>{{__('افزودن قیمت و موجودی برای متغییر :')}}</span>
                        <span id="variationName" class="font-weight-bold"></span>
                    </h6>

                    <div class="row">
                        <div class="col-md-12">
                            <div id="czContainer" class="row">
                                <div id="first">
                                    <div class="recordset d-flex justify-content-between mx-auto my-2">
                                        <div class="row">
                                            {{--  Product   value --}}
                                            <div class="col">
                                                <label for="value">{{ __('نام') }}</label>
                                                <input type="text" name="variation_values[value][]" id="value" class="form-control" dir="auto"/>
                                            </div>
                                            {{-- end Product value   --}}

                                            {{--  Product price --}}
                                            <div class="col">
                                                <label for="price">{{ __('قیمت') }}</label>
                                                <input type="text" name="variation_values[price][]" id="price" class="form-control" dir="auto"/>
                                            </div>
                                            {{-- end Product price   --}}

                                            {{--  Product quantity --}}
                                            <div class="col">
                                                <label for="quantity">{{ __('تعداد') }}</label>
                                                <input type="number" name="variation_values[quantity][]" id="quantity" class="form-control" dir="ltr"/>
                                            </div>
                                            {{-- end Product quantity   --}}

                                            {{--  Product quantity --}}
                                            <div class="col">
                                                <label for="sku">{{ __('شناسه انبار') }}</label>
                                                <input type="number" name="variation_values[sku][]" id="sku" class="form-control" dir="ltr"/>
                                            </div>
                                            {{-- end Product sku   --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- The elements you want repeated must be wrapped in an element with id="recordset" -->
                        </div>
                    </div>
                </div>
                {{-- End Product images --}}



            </div>
            <div class="row">
                {{-- product and attributes --}}
                <div class="col-md-12" id="variationContainer">
                    <h6>
                        <i class="fa fa-fw fa-caravan mx-2"></i>
                        <span>{{__('افزودن هزینه ارسال :')}}</span>
                        <span id="variationName" class="font-weight-bold"></span>
                    </h6>
                    <div class="row">
                        <div class="col-md-3">
                            {{-- brand Product   --}}
                            <div class="col">
                                <label for="delivery_amount">{{ __('هزینه ارسال :') }}</label>
                                <input type="text" name="delivery_amount" id="delivery_amount" class="form-control" placeholder="{{ __('هزینه ارسال') }}" value="{{ old('delivery_amount')}}"/>
                            </div>
                            {{-- end Product   --}}
                        </div>
                        <div class="col-md-3">
                            {{-- brand Product   --}}
                            <div class="col">
                                <label for="delivery_amount_per_pro">{{ __('هزینه ارسال به ازای محصول اضافی :') }}</label>
                                <input type="text" name="delivery_amount_per_pro" id="delivery_amount_per_pro" class="form-control" placeholder="{{ __('هزینه ارسال به ازای محصول اضافی') }}" value="{{ old('name')}}" />
                            </div>
                            {{-- end Product   --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- button --}}
            <div class="my-4">
                <button class="btn btn-md btn-primary" type="submit">{{ __('ثبت محصول') }}</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-dark mx-3">{{ __('بازگشت') }}</a>
            </div>
        </form>
    </div>
</div>

@endsection
