<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $product = $this->route('product',0);
        $id = $product? $product->id : 0;
        return [
            'name' =>'required|max:255|min:3',
            'slug' => "required|unique:products,slug,{$id}",
            'category_id' =>'nullable|int|exists:categories,id',
            'description' =>'nullable|string',
            'short_description' =>'nullable|string|max:500',  
            'price' =>'required|numeric|min:0',
            'compare_price' =>'nullable|numeric|min:0|gt:price',
            'image' =>'nullable|image|dimensions:min_width=400,min_height=300|max:1024',
            'status' =>'required|in:active,draft,archived',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image',
        ];
    }
    public function messages(): array
    {
        return
        [
            'required' => ':attribute field is require!',
            'unique' => 'The value alredy exists!',
            'name.required'=>'The product name is mandatory!',
        ];
    }
}
