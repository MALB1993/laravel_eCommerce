<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

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
     * @return array
     */
    #[ArrayShape(['name' => "string[]", 'slug' => "string[]", 'attribute_ids' => "string[]", 'attribute_is_filter_ids' => "string[]", 'variation_id' => "string[]", 'icon' => "string[]", 'description' => "string[]"])]
    public function rules(): array
    {
        return [
            'name'                     =>   ['required','string','min:4','max:50'],
            'slug'                     =>   ['required','min:4','max:50','unique:categories,slug'],
            'attribute_ids'            =>   ['required'],
            'attribute_is_filter_ids'  =>   ['required'],
            'variation_id'             =>   ['required','numeric'],
            'icon'                     =>   ['nullable','string'],
            'description'              =>   ['nullable'],
        ];
    }
}
