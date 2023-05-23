@extends('Admin.partials.master')
@section('title')
    {{ __('ایجاد محصول جدید') }}
@endsection
@section('scripts')
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
        })
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
            {{-- button --}}
            <div class="my-4">
                <button class="btn btn-md btn-primary" type="submit">{{ __('ثبت محصول') }}</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-dark mx-3">{{ __('بازگشت') }}</a>
            </div>
        </form>
    </div>
</div>

@endsection
