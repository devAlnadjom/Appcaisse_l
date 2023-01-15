<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

            'email_ui' => 'required|email',
            'level_ui' => 'numeric',
            'group_ui' => '',
            'nom_p_ui' => 'string|max:100',
            'poste_ui' => 'string',
            'date_cr_ui' => '',
            'contact_ui' => ' ',
            'data1_ui' => '',
            'permissions' => 'array',

        ];
    }


    protected function prepareForValidation()
    {
        $this->merge([
            'data1_ui' => time(),
        ]);
    }
}
