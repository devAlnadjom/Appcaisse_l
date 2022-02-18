<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDemandeRequest extends FormRequest
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

            'montant_pdc' => 'required|numeric',
            'concept_pdc' => 'required|string',
            'projet_pdc' => 'required|numeric',
            'receveur_pdc' => 'required|strind|max:50',
            'code_service_pdc' => 'required|strind|max:10',
        ];
    }


    protected function prepareForValidation()
        {
            $this->merge([
                'id_restapayer_pdc' => $this->montant_pdc,
                'timestamp_pdc' => time(),
                'date_cr_pdc'=> $new_date = date("Y-m-d", time()),
                'etat_valide_pdc'=> 1,
            ]);
        }
}
