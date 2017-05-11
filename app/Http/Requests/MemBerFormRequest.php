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
            'name'  => 'required|max:100|not_in:undefined',
            'age'   => 'required|digits_between:1,2|numeric',
            'address'   => 'required|max:300|not_in:undefined',
            'photo' => 'nullable|image|mimes:jpeg,gif,png|max:10240',
        ];
    }

    public function all()
    {
        $values = parent::all();

        if ($values['photo'] === 'null') {
            $values['photo'] = null;
        }

        return $values;
    }
}
