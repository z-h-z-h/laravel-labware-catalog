<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategory extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        return [
            'title' => 'required|string|min:3|max:21',
            'description' => 'required|string|min:5|max:250',
            'slug' => '|string|min:3|max:21|nullable',
            'parent_id' => ['nullable', 'string', 'min:0', 'max:100', function ($attribute, $value, $fail) {

                if ($value !== 'null' && $this->category->nestedCategories->count() !== 0) {
                    $fail(' Нельзя изменить родительскую категорию на вложенную пока у нее есть вложенные категории.');
                }
            }],
            'company_id' => 'required|string|min:1|max:3',
            'image' => 'mimes:jpeg,png,gif|max:10240',
        ];
    }
}

