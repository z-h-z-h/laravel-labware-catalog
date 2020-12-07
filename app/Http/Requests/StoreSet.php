<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSet extends FormRequest
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
            'code' => 'required|string|min:3|max:10',
            'slug' => '|string|min:3|max:21|nullable',
            'category_id' => 'required|string|min:1|max:5',

            //'image' => 'mimes:jpeg,bmp,png,gif',

        ];
    }
}
