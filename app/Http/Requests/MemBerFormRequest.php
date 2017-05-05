<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemBerFormRequest extends FormRequest
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
            'name'  => 'max:100',
            'age'   => 'digits_between:1,2',
            'address'   => 'max:300',
            'photo' => 'mimes:jpeg,gif,png|max:10240',
        ];
    }
}
