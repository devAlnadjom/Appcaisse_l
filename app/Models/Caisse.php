<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Caisse extends Model
{
    use HasFactory;
    protected $table = 'finn_com';
    protected $primaryKey = 'id_finn';
    protected $guarded= [];
    public $timestamps = false;



    public static function solde(){
        return ( DB::table('finn_com')
        ->orderBy('id_finn', 'desc')
        ->first()->solde_finn);
    }

    public static function soldeDuMois($Month= null){
        $Month= isset($Month)?$Month : Carbon::now()->subMonth()->month;


        $res = DB::table('finn_com')->whereMonth("date_finn","=",$Month)
        ->orderBy('id_finn', 'desc')
        ->first()?->solde_finn;

        return $res ? $res : 0;
    }



    public function projet(){
        return $this->belongsTo(Projet::class,'cod_proj_finn','id_projet');
    }

    public function service(){
        return $this->belongsTo(Service::class,'code_service_finn','cod_ser');
    }

    public function cdc(){
        return $this->belongsTo(Cdc::class,'code_cdc_finn','code_cdc');
    }


}
