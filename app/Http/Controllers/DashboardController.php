<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Account;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {

        dd(Demande::myDemandes());

        $card_stat = array(
            'users' => DB::table('users_in')->count(),
            'pdcs' => DB::table('pdc')->count(),
            'projets' => DB::table('projet')->count(),
            'solde' => number_format( DB::table('finn_com')
                    ->orderBy('id_finn', 'desc')
                    ->first()->solde_finn),

        );
        return Inertia::render('Dashboard', [
            'users' => Account::paginate(10),
            'card_stat'=>$card_stat,

        ]);
    }
}
