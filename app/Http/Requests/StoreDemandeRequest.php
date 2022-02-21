<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'receveur_pdc' => 'required|string|max:50',
            'code_service_pdc' => 'required|string|max:10',
            'id_restapayer_pdc' => 'numeric',
            'timestamp_pdc' => '',
            'date_cr_pdc'=> '' ,
            'etat_valide_pdc'=> 'numeric',
            'is_visible'=>'numeric',
            'id_demandeur_pdc'=>'numeric',
            'date_paye_pdc'=>'',
            'auth_par_pdc'=>'',
            'data1_pdc'=>'',
            'data2_pdc'=>'',
            'data3_pdc'=>'',
            'team_l'=>'',
            'team_l_valide'=>'',
            'dt_l'=>'',

        ];
    }


    protected function prepareForValidation()
        {
            $this->merge([
                'id_restapayer_pdc' => $this->montant_pdc,
                'timestamp_pdc' => time(),
                'date_cr_pdc'=> date("Y-m-d", time()),
                'date_paye_pdc'=> date("Y-m-d", time()),
                'data1_pdc'=> date("Y-m-d", time()),
                'data2_pdc'=> 0,
                'team_l_valide'=> 0,
                'etat_valide_pdc'=> 1,
                'is_visible'=>0,
                'dt_l'=>"",
                'auth_par_pdc'=>0,
                'id_demandeur_pdc'=>Auth::user()->users_in_id,
            ]);
        }
}
