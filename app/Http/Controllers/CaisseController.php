<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Caisse;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Actions\CustomPermission;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreApproRequest;
use App\Http\Requests\StorePaymentRequest;

class CaisseController extends Controller
{
    //
    public function index(Request $request)
    {

        $solde=Caisse::solde();
       CustomPermission::check("caisse");

       $demande= Demande::where('id_restapayer_pdc','!=','0')
                        ->where("etat_valide_pdc","2") //change id
                        ->with(['projet','service'])
                        ->orderBy('id_pdc', 'desc')
                        ->filter($request->only('search'/*, 'trashed'*/))
                        ->paginate(10)
                        ->withQueryString();


        return Inertia::render('Caisse/Index', [
            'demandes' => $demande,
            'card_stat'=>array(),
            'solde'=>$solde,
            'filters' => $request->all('search', 'trashed'),
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


    public function appro_show_form()
    {
        $solde=Caisse::solde();

       CustomPermission::check("can_pay");

                return Inertia::render('Caisse/Appro_add', [
                    'solde' => $solde,
                ]);
    }


    public function payer(StorePaymentRequest $rq)
    {
       // dd((Caisse::solde()) );
        $solde= Caisse::solde()- $rq->sortie_finn;
        if($solde < 0)
        return redirect()->back()->with('success',"Montant en caisse insuffisant.");

        $data= $rq->validated();
        $demande=Demande::find($rq->data2_finn);
        $check= $demande->id_restapayer_pdc - $rq->sortie_finn ;
        abort_if ($check<0, "403", "Operation Impossible. Le montant saisi est superieur au montant demandé...");

         $caisse=Caisse::create($data);
         $caisse->update(['solde_finn'=>$solde]);

         $demande->decrement('id_restapayer_pdc',$rq->sortie_finn);
         usleep(300000);

        return redirect()->route('caisse.index')->with('success',"Le paiement demandée a été effectué.");
    }

    public function approvisionner(StoreApproRequest $rq)
    {
       // dd((Caisse::solde()) );
        $solde= Caisse::solde()+ $rq->entre_finn;

        $data= $rq->validated();

         $caisse=Caisse::create($data);
         $caisse->update(['solde_finn'=>$solde]);
         usleep(400000);

        return redirect()->route('caisse.index')->with('success',"La Caisse a éte bien approvisionnée.");
    }


    public function brouillard()
    {
        $SoldePrecedent= Caisse::soldeDuMois();
        $ligne= Caisse::whereMonth('date_finn','=',Carbon::today()->month)
                ->with(['cdc:code_cdc,libelle_cdc','projet:id_projet,libelle_projet','service:cod_ser,libelle_ser'])
                ->get();
        //dd($ligne);
       return view("brouillard",compact('SoldePrecedent','ligne'));
    }
}
