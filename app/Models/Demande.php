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
        return Demande::where('id_demandeur_pdc',Auth::user()->id)
                ->with(['projet','service'])
                ->paginate(10);
    }
}
