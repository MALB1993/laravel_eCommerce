<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'                     =>   ['required','string','min:4','max:50'],
            'slug'                     =>   ['required','min:4','max:50','unique:categories,slug'],
            'attribute_ids'            =>   ['required'],
            'attribute_is_filter_ids'  =>   ['required'],
            'variation_id'             =>   ['required','numeric'],
            'icon'                     =>   ['nullable','string'],
            'description'              =>   ['nullable','alpha:ascii'],
        ];
    }
}
