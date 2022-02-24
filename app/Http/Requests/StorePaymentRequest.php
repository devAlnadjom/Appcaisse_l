<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'type_finn' => '',                               //Depenses
            'data2_finn' => 'required',
            'date_finn' => '',
            'sortie_finn' => 'numeric',
            'entre_finn' => '', // pas d'entré mais de sortie
            'cod_proj_finn' => 'required',
            'code_cdc_finn' => 'required',
            'code_service_finn' => 'required',
            'remarque_finn' => '',

        ];
    }


    protected function prepareForValidation()
    {
        $this->merge([
            'data1_finn' => Auth::user()->users_in_id,
            'type_finn' => 1,
            'date_finn' => date('Y-m-d H:i:s'),
            'entre_finn' => 0,
            'solde_finn' =>0,
            'remarque_finn' =>'',

        ]);
    }
}
