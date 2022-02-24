<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Demande;
use Illuminate\Http\Request;
use App\Actions\CustomPermission;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Caisse;
use Illuminate\Support\Facades\DB;

class CaisseController extends Controller
{
    //
    public function index()
    {

        $solde=Caisse::solde();
       CustomPermission::check("caisse");

        return Inertia::render('Caisse/Index', [
            'demandes' => Demande::waitingPayment(),
            'card_stat'=>array(),
            'solde'=>$solde,

        ]);
    }


    public function pay(Demande $demande)
    {
        $solde=Caisse::solde();
        $cdc=  DB::table('centre_des_couts')
        ->where('data1_cdc', '1')
        ->orderBy('libelle_cdc', 'asc')
        ->get(['code_cdc','libelle_cdc']);

       CustomPermission::check("can_pay");

                return Inertia::render('Caisse/View', [
                    'demande' => $demande->load(['projet','service', 'account','bcomande']),
                    'solde' => $solde,
                    'cdc' => $cdc,

                ]);
    }


    public function payer(StorePaymentRequest $rq)
    {
       // dd((Caisse::solde()) );
        $solde= Caisse::solde()- $rq->sortie_finn;
        if($solde < 0)
        return redirect()->back()->with('success',"Montant en caisse insuffisant.");

        $data= $rq->validated();
         $caisse=Caisse::create($data);
         $caisse->update(['solde_finn'=>$solde]);
         Demande::find($rq->data2_finn)->decrement('id_restapayer_pdc',$rq->sortie_finn);



        return redirect()->route('caisse.index')->with('success',"Votre piece de caisse a éte bien soumis.");
    }
}
