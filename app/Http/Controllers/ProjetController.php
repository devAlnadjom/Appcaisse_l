<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjetController extends Controller
{
    public function index()
    {
        $active_projects =  Projet::where('data1_projet',1)->count();

        return Inertia::render('Projets/Index', [
            'projets' => Projet::where('data1_projet','<>','0')->paginate(),
            'active_projet' => $active_projects,
        ]);
    }

    public function create()
    {

        return Inertia::render('Projets/Create', [
            'projets' => Projet::pluck('libelle_projet')
        ]);
    }

    public function store(Request $rq)
    {
        $data = $rq->validate([
            'libelle_projet' => 'required|max:80|min:5',
            'data_projet' => 'required|max:100|min:5',
        ]);
        Projet::create($data + ['data1_projet' => 1]);

        return redirect()->route('projets.index')->with('success',"Projet ajouté.");
    }


    public function edit(Projet $projet) {

        return Inertia::render('Projets/Edit', [
            'projet' => $projet
        ]);
    }

    public function update(Request $rq)
    {

        return redirect()->route('projets.index')->with('success',"Projet Modifié.");
    }
}
