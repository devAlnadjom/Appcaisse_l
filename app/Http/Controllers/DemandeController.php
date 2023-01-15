<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDemandeRequest;
use App\Models\Account;
use App\Models\Bcommande;
use Inertia\Inertia;
use App\Models\Demande;
use App\Models\Projet;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{

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
        return Inertia::render('Demandes/My_demandes', [
            'demandes' => Demande::myDemandes(),
            'card_stat'=>array(),//$card_stat,

        ]);
    }


    public function waitingMyAuthorization()
    {

        return Inertia::render('Demandes/Waiting_authorization', [
            'demandes' => Demande::waitingMyAuthorization(),
            'card_stat'=>array(),//$card_stat,

        ]);
    }
    public function create()
    {
        $service= Service::Where("data1_ser","1")
                            ->get();
        $projet= Projet::Where("data1_projet","1")
                            ->get();

        $bcommande= Bcommande::Where("data3_bc","1")
                            ->get();
        $manager= Account::Where("level_ui","20")->orWhere("level_ui",">","30")->Where("active_ui","1")
                            ->get();
        $auth= Account::Where("id_ui",Auth::user()->users_in_id)->firstOrFail();


                return Inertia::render('Demandes/Create', [
                    'services' => $service,
                    'projets' => $projet,
                    'commandes' => $bcommande,
                    'managers' => $manager,
                    'isManager' => ($auth->level_ui*1 > 19)?true:false,
                ]);
    }



    public function store(StoreDemandeRequest $rq)
    {
        $data= $rq->validated();//safe();//->except(['picture']);
        $demande= Demande::create($data);


        return redirect()->route('demandes.show',$demande->id_pdc)->with('success',"Votre piece de caisse a éte bien soumis.");
    }



    public function show($id)
    {
        $demande= Demande::where('id_pdc',$id)
                    ->with(['projet','service', 'account','bcomande'])->firstOrfail();

                return Inertia::render('Demandes/View', [
                    'demande' => $demande,
                ]);
    }



    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
