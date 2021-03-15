<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompany extends FormRequest
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
            'slug' => 'string|min:3|max:21|nullable',
            'image' => 'mimes:jpeg,png,gif|max:10240',
        ];
    }
}
