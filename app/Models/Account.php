<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table = 'users_in';
    protected $primaryKey = 'id_ui';


    public function user(){
        return $this->hasOne(User::class,'users_in_id');
    }

    public function demandes(){
        return $this->hasMany(Demande::class,'id_demandeur_pdc');
    }


}
