<?php

namespace App\Http\Controllers;

use App\Models\Cdc;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CdcController extends Controller
{
    public function index()
    {
        $active_cdcs =  Cdc::where('data1_cdc',1)->count();

        return Inertia::render('Cdc/Index', [
            'cdcs' => Cdc::where('data1_cdc','<>','0')->paginate(),
            'active_cdc' => $active_cdcs,
        ]);
    }

    public function create()
    {

        return Inertia::render('Cdc/Create', [
            'cdcs' => Cdc::pluck('code_cdc')
        ]);
    }

    public function store(Request $rq)
    {
        $data = $rq->validate([
            'libelle_cdc' => 'required|max:80|min:5',
            'code_cdc' => 'required|max:10|min:3',
        ]);
        Cdc::create($data + ['data1_cdc' => 1, 'data2_cdc' => '']);

        return redirect()->route('cdcs.index')->with('success',"Cdc ajouté.");
    }


    public function edit(Cdc $cdc) {

        return Inertia::render('Cdc/Edit', [
            'cdc' => $cdc
        ]);
    }

    public function update(Request $rq)
    {

        return redirect()->route('cdcs.index')->with('success',"Cdc Modifié.");
    }
}
