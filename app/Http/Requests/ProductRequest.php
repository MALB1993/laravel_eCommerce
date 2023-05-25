<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $primary_image
 * @property mixed $images
 * @property mixed $name
 * @property mixed $brand_id
 * @property mixed $category_id
 * @property mixed $description
 * @property mixed $is_active
 * @property mixed $delivery_amount
 * @property mixed $delivery_amount_per_pro
 * @property mixed $attribute_ids
 * @property mixed $variation_values
 * @property mixed $tag_ids
 */
class ProductRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name'                          =>     ['required'],
            'brand_id'                      =>     ['required'],
            'is_active'                     =>     ['required'],
            'tag_ids'                       =>     ['required'],
            'description'                   =>     ['required'],
            'primary_image'                 =>     ['required','mimes:jpg,jpeg,png,webp,svg,gif'],
            'images'                        =>     ['required'],
            'images.*'                      =>     ['mimes:jpg,jpeg,png,webp,svg,gif,webm'],
            'category_id'                   =>     ['required'],
            'attribute_ids'                 =>     ['required'],
            'attribute_ids.*'               =>     ['required'],
            'variation_values'              =>     ['required'],
            'variation_values.*.*'          =>     ['required'],
            'variation_values.price.*'      =>     ['integer'],
            'variation_values.quantity.*'   =>     ['integer'],
            'delivery_amount'               =>     ['required','integer'],
            'delivery_amount_per_product'   =>     ['nullable','integer'],

        ];
    }
}
