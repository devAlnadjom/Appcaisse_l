<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cdc extends Model
{
    use HasFactory;
    protected $table = 'centre_des_couts';
    protected $primaryKey = 'code_cdc';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded= [];
    public $timestamps = false;


}
