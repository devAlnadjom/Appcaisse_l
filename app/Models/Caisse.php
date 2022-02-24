<?php

namespace App\Models;

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
}
