<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreApproRequest extends FormRequest
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
            'data1_finn' => 'numeric',
            'libelle_finn' => 'required|string',
            'source_finn' => 'required|string',
            'solde_finn' =>'' ,
            'type_finn' => '',
            'data2_finn' => '',
            'date_finn' => '',
            'sortie_finn' => '',
            'entre_finn' => 'numeric',
            'cod_proj_finn' => '',
            'code_cdc_finn' => '',
            'code_service_finn' => '',
            'remarque_finn' => '',

        ];
    }


    protected function prepareForValidation()
    {
        $this->merge([
            'data1_finn' => Auth::user()->users_in_id,
            'type_finn' => 2,
            'date_finn' => date('Y-m-d H:i:s'),
            'sortie_finn' => 0,
            'data2_finn' => 0,
            'solde_finn' =>0,
            'remarque_finn' =>'',
            'cod_proj_finn' => '1',
            'code_cdc_finn' => 'AAA',
            'code_service_finn' => 'AAA',

        ]);
    }
}
