<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Demande;
use Illuminate\Http\Request;

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


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $demande= Demande::where('id_pdc',$id)
                    ->with(['projet','service', 'account','bcomande'])->firstOrfail();

                return Inertia::render('Demandes/View', [
                    'demande' => $demande,
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
