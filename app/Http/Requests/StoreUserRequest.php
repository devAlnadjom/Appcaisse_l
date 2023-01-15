<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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

            'login_ui' => 'required|email',
            'password_ui' => ['required',
                                'string',
                                'min:8',             // must be at least 10 characters in length
                                'regex:/[a-z]/',      // must contain at least one lowercase letter
                              //  'regex:/[A-Z]/',      // must contain at least one uppercase letter
                              // 'regex:/[0-9]/',      // must contain at least one digit
                              //  'regex:/[@$!%*#?&]/'
                            ],
            'c_password_ui' => 'required|same:password_ui',
            'email_ui' => 'required|email',
            'level_ui' => 'numeric',
            'group_ui' => '',
            'nom_p_ui' => 'string|max:100',
            'poste_ui' => 'string',
            'date_cr_ui' => '',
            'contact_ui' => ' ',
            'active_ui' => '',
            'data1_ui' => '',
            'data2_ui' => '',
            'permissions' => 'array',

        ];
    }


    protected function prepareForValidation()
    {
        $this->merge([
            'data1_ui' => time(),
            'data2_ui' => '00000',
            'group_ui' => '10',
            'active_ui' => 1,
            'date_cr_ui' =>time(),

        ]);
    }
}
