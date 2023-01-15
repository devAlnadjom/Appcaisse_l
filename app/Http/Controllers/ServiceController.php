<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function index()
    {
        return Inertia::render('Services/Index', [
            'services' => Service::paginate()
        ]);
    }

    public function create()
    {
        return Inertia::render('Services/Create', [
            'services' => Service::pluck('cod_ser')
        ]);
    }

    public function store(Request $rq)
    {
        $data = $rq->validate([
            'cod_ser' => 'required|max:10|min:3',
            'libelle_ser' => 'required|max:100|min:5',
        ]);
        Service::create($data + ['data1_ser' => 1, 'data2_ser' => '']);

        return redirect()->route('services.index')->with('success',"Serice ajouté.");
    }


    public function edit(Service $service) {

        return Inertia::render('Services/Edit', [
            'service' => $service
        ]);
    }

    public function update(Request $rq)
    {

        return redirect()->route('services.index')->with('success',"Compte Utilisateur Modifié.");
    }
}
