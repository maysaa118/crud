<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $category = $this->route('category',0);
        $id = $category? $category->id : 0;
        return [
            'name' =>'required|max:255|min:3',
            'category_id' =>'nullable|int|exists:categories,id',
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
