<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bcommande extends Model
{
    use HasFactory;
    protected $table = 'b_commande';
    protected $primaryKey = 'id_bc';
}
