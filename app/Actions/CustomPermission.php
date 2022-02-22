<?php

namespace App\Actions;

use App\Models\User;
use App\Models\Account;
use Exception;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class CustomPermission {
    public static function check($_permission) {


        $auth= Account::Where("id_ui",Auth::user()?->users_in_id)->first();
        $permission= $auth ? json_decode($auth->permissions,1) :null;
        if(array_key_exists($_permission,$permission))
            if(!$permission || $permission[$_permission] !="true" ){
                abort("403","Vous n'êtes pas authorise a acceder à cet espace.");

            }


    }
}
