@extends('admin.layouts.master')

@section('title', __('edit product category'))

@section('content')
    <div class="col-md-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white p-2 shadow rounded">
            <h5 class="font-weight-bold">{{ __('Products') }}</h5>
            <a href="{{ route('admin-panel.products.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-eye fa-sm text-white-50"></i>
                {{ __('Index products') }}
            </a>
        </div>

        <div class="my-2 bg-white border shadow rounded p-4">
            <form action="{{ route('admin-panel.products.category.update',['product' => $product->slug]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- divider --}}
                    <div class="col-md-12">
                        <hr>
                        <h6>
                            <b>{{ __('Categories and Attributes') }}</b>
                        </h6>
                    </div>


                    {{-- category id --}}
                    <div class="form-group col-md-12">
                        <label for="categorySelect">{{ __("Brand") }}</label>
                        <select name="category_id" id="categorySelect" class="form-control form-select @error('category_id') is-invalid @enderror">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $product->category->id ? 'selected' : '' }} >{{ $category->name }} -  {{ $category->parent->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row my-2" id="attributeRow">

                    <div class="col-md-12">
                        <div class="row" id="attributeContainer">

                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr>
                        <h6>
                            <b>
                                {{ __('Add price and inventory for variable') }}
                                <span class="text-success font-wight-bold" id="variationName"></span>
                                :
                            </b>
                        </h6>
                    </div>
                    <div class="col-md-12 p-0">
                        <div id="czContainer">
                            <div id="first">
                                <div class="recordset">
                                    <div class="row">
                                        {{-- variation_values[value] --}}
                                        <div class="form-group col-md-3">
                                            <label for="variation_values">{{ __("Name") }}</label>
                                            <input type="text" name="variation_values[value][]" class="form-control dir="auto">
                                        </div>

                                        {{-- variation_values[price] --}}
                                        <div class="form-group col-md-3">
                                            <label for="variation_values">{{ __("Price") }}</label>
                                            <input type="text" name="variation_values[price][]" class="form-control dir="auto">
                                        </div>

                                        {{-- variation_values[quantity] --}}
                                        <div class="form-group col-md-3">
                                            <label for="variation_values">{{ __("Quantity") }}</label>
                                            <input type="text" name="variation_values[quantity][]"class="form-control" dir="auto">
                                        </div>

                                        {{-- variation_values[sku] --}}
                                        <div class="form-group col-md-3">
                                            <label for="variation_values">{{ __("Sku") }}</label>
                                            <input type="text" name="variation_values[sku][]" class="form-control" dir="auto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
