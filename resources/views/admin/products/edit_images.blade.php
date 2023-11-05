@extends('admin.layouts.master')

@section('title', __('edit products images'))

@section('stylesheet')
    <style>
        .custom-file-label::after{
            content : "{{ __('File') }}" !important;
        }

        .custom-file-label:after{
            right: unset;
            left: 0;
            border-left: unset;
            border-right: inherit;
            border-radius: 0.35rem 0 0 0.35rem;
        }

    </style>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">{{ __('Products') }}</h5>
            <a href="{{ route('admin-panel.products.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i>
                {{ __('edit product image') }}
            </a>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            @include('errors.error')
            <div class="col-md-12">
                <h6>
                    <b>{{ __('edit product images') }}</b>
                </h6>
            </div>

            <div class="col-md-12 border p-3">
                <p>{{ __('Primary image') }}</p>
                <img src="{{ asset(env('PRODUCT_IMAGE_UPLOAD_PATH') .$product->primary_image ) }}" alt="" width="200" height="200" class="img-thumbnail img-fluid">
            </div>

            <hr>

            <div class="col-md-12 border p-3 my-2">
                <p>{{ __('Images') }}</p>
                <div class="row">
                    @foreach ($product->images as $item)

                        <div class="col-md-3 border p-2 img-thumbnail">
                            <img src="{{ asset(env('PRODUCT_IMAGE_UPLOAD_PATH') .$item->image ) }}" alt="" class="img-fluid my-1">

                            <div class="d-flex justify-content-center">
                                <form action="{{ route('admin-panel.products.image.destroy',['product' => $product->slug]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="image_id" value="{{ $item->id }}">
                                    <button class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                                </form>

                                <form action="{{ route('admin-panel.products.image.set_primary',['product' => $product->slug]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="image_id" value="{{ $item->id }}">
                                    <button class="btn btn-sm btn-primary">{{ __('Select the image as the indicator') }}</button>
                                </form>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <hr>
            <form action="{{ route('admin-panel.products.image.add', ['product' => $product->slug]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        {{-- primary image --}}
                        <div class="form-group col-md-6">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('primary_image') is-invalid @enderror" id="primary_image" name="primary_image" aria-describedby="primary_image">
                                <label class="custom-file-label" for="primary_image">{{ __('Choose File') }}</label>
                            </div>
                            @error('primary_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- images --}}
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3" dir="ltr">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('images') is-invalid @enderror" id="images" name="images[]" aria-describedby="images" multiple="true ">
                                    <label class="custom-file-label" for="images">{{ __('Choose Files') }}</label>
                                </div>
                            </div>
                            @error('images')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- buttons --}}
                    <div class="btn-group" dir="ltr">

                        <a href="{{ url()->previous() }}" class="btn btn-dark">
                            {{ __('Go back') }}
                        </a>

                        <button type="submit" class="btn btn-md btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
            </form>
        </div>

    </div>


@endsection

@section('javascript')
<script>
    // brands
    $('#brand_id').selectpicker({
        liveSearch: true,
        liveSearchPlaceholder: "{{ __('Searching') }}",
        multipleSeparator: " | ",
        title: "{{ __('Please select at least one brand.') }}"
    });
    // status
    $('#is_active').selectpicker({
        liveSearch: true,
        liveSearchPlaceholder: "{{ __('Searching') }}",
        multipleSeparator: " | ",
        title: "{{ __('Please select at least one ability.') }}"
    });

    // categories
    $('#categorySelect').selectpicker({
        liveSearch: true,
        liveSearchPlaceholder: "{{ __('Searching') }}",
        multipleSeparator: " | ",
        title: "{{ __('Please select at least one categories.') }}"
    });

    $('#tagSelect').selectpicker({
        liveSearch: true,
        liveSearchPlaceholder: "{{ __('Searching') }}",
        multipleSeparator: " | ",
        title: "{{ __('Please select at least one tags.') }}"
    });

    $("#primary_image").change(function(){
        let fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName)
    });

    $("#images").change(function(){
        let fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName)
    });

    // attribute select jquery
    $("#attributeRow").hide();
    $('#categorySelect').on('changed.bs.select', function(e, clickedIndex, isSelected, previousValue) {
        let categoryId = $(this).val();

        $.get(`{{ url('/admin-panel/management/category-attributes-list/${categoryId}') }}` , function (response, status) {

            if(status == 'success')
            {
                // console.log(response);
                $("#attributeRow").fadeIn();
                // remove attribute categories
                $("#attributeContainer").find('div').remove();

                // append attribute inputs
                response.attributes.forEach( (attribute)=>{
                    // create form group
                    let attributeFormGroup  =   $('<div/>',{class : "form-group col-md-3"});

                    // create form label
                    let attributeFormLabel  =   attributeFormGroup.append($('<label/>',{for: attribute.name , text : attribute.name}));

                    // create form input
                    attributeFormGroup.append($('<input/>',{ class : "form-control", type: "text", id: attribute.name, name : `attribute_ids[${attribute.id}]`}));

                    // append all label and input to attribute containers
                    $("#attributeContainer").append(attributeFormGroup);
                });

                $("#variationName").text(response.variations.name);
            }
            else
            {
                console.warn('moshkel dar daryaft etelaat');
            }

        }).fail(function(){
            console.error('moshkel dar daryaft list');
        });
    });

    $("#czContainer").czMore();
</script>
@endsection
