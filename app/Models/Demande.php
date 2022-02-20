<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Demande extends Model
{
    use HasFactory;
    protected $table = 'pdc';
    protected $primaryKey = 'id_pdc';
    protected $guarded= [];

    public function account(){
        return $this->belongsTo(Account::class,'id_demandeur_pdc','id_ui');
    }

    public function projet(){
        return $this->belongsTo(Projet::class,'projet_pdc','id_projet');
    }

    public function service(){
        return $this->belongsTo(Service::class,'code_service_pdc','cod_ser');
    }
    public function bcomande(){
        return $this->belongsTo(Bcommande::class,'data3_pdc','id_bc');
    }

    public static function myDemandes(){
        return Demande::where('id_demandeur_pdc',Auth::user()->users_in_id)
                ->where("is_visible","0") //change id
                ->with(['projet','service'])->orderBy('id_pdc', 'desc')
                ->paginate(10);
    }


    public static function myArchive(){
        return Demande::where('id_demandeur_pdc',Auth::user()->users_in_id)
                ->where("is_visible","1") //change id
                ->with(['projet','service'])
                ->paginate(10);
    }


    public static function waitingMyAuthorization(){
        return Demande::where('team_l',Auth::user()->users_in_id)
                ->where("etat_valide_pdc","5") //change id
                ->with(['projet','service'])
                ->paginate(10);

    }

    public static function waitingpayment(){
        return Demande::where('id_restapayer_pdc','!=','0')
                ->where("etat_valide_pdc","2") //change id
                ->with(['projet','service'])
                ->paginate(10);

    }




    public function authorize(){

      return  $this->update([
            'etat_valide_pdc' => 1, // Veut dire qu'un manager peut acceder a une donné
            'team_l_valide' => 1
        ]);
    }


    public function markAsPaid(){

      return  $this->update([
            'etat_valide_pdc' => 3
        ]);
    }

    public function approuve(){

        return  $this->update([
            'data1_pdc' => date('Y-m-d H:i:s'),
            'etat_valide_pdc' => 2, // Veut dire que la pièce est autoriser par un Manager
            'auth_par_pdc' => Auth::user()->users_in_id
    ]);

    }

    public function reject(){

        return  $this->update([
            'data1_pdc' => date('Y-m-d H:i:s'),
            'etat_valide_pdc' => 0, // Veut dire que la pièce est rejejeter par un Manager
            'auth_par_pdc' => Auth::user()->users_in_id
        ]);

    }

    public function archive(){

        return  $this->update([
            'is_visible' => 0,
        ]);

    }

    //public function reject(){}


}
