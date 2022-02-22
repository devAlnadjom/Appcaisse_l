<?php

namespace App\Http\Controllers;

use App\Actions\CustomPermission;
use Inertia\Inertia;
use App\Models\Account;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ApprobationController extends Controller
{
    //
    public function index()
    {
         // dd(Demande::myDemandes());

        /* $card_stat = array(
            'users' => DB::table('users_in')->count(),
            'pdcs' => DB::table('pdc')->count(),
            'projets' => DB::table('projet')->count(),
            'solde' => number_format( DB::table('finn_com')
                    ->orderBy('id_finn', 'desc')
                    ->first()->solde_finn),

        );*/
       CustomPermission::check("validation");

        return Inertia::render('Demandes/Approbations', [
            'demandes' => Demande::waitingApprobation(),
            'card_stat'=>array(),//$card_stat,

        ]);
    }


    public function waitingPayment()
    {
         // dd(Demande::myDemandes());

        /* $card_stat = array(
            'users' => DB::table('users_in')->count(),
            'pdcs' => DB::table('pdc')->count(),
            'projets' => DB::table('projet')->count(),
            'solde' => number_format( DB::table('finn_com')
                    ->orderBy('id_finn', 'desc')
                    ->first()->solde_finn),

        );*/
       CustomPermission::check("validation");

        return Inertia::render('Demandes/Waiting_payment', [
            'demandes' => Demande::waitingPayment(),
            'card_stat'=>array(),//$card_stat,

        ]);
    }

    public function approuve(Demande $demande)
    {
       CustomPermission::check("can_validate");
        $demande->approuve();
        return redirect()->route("approbation.index")->with("success","Demande validée.");
    }

    public function reject(Demande $demande)
    {
       CustomPermission::check("can_validate");
        $demande->reject();
        return redirect()->route("approbation.index")->with("success","Demande rejetée.");
    }

    public function _authorize(Demande $demande)
    {
       CustomPermission::check("can_validate");
        $demande->authorize();
        return redirect()->route("demandes.authorization")->with("success","Demande authorisé.");
    }

    public function archive(Demande $demande)
    {
       CustomPermission::check("can_validate");
        $demande->archive();
        return redirect()->route("demandes.index")->with("success","Demande Archivé.");
    }

}
