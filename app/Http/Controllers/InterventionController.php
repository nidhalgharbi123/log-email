<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Http\Requests\StoreInterventionRequest;
use App\Http\Requests\UpdateInterventionRequest;
use Illuminate\Http\Request;


class InterventionController extends Controller
{
    public function index()
    {
        $interventions = Intervention::all();
        return view('interventions.index', compact('interventions'));
    }

    public function create()
    {
        return view('interventions.create');

    }

    public function store(StoreInterventionRequest $request)
    {
        // Valider et récupérer les données du formulaire
        $validatedData = $request->validated();
    
        // Créer une nouvelle instance d'Intervention avec les données validées
        $intervention = Intervention::create($validatedData);
    
        // Rediriger avec un message de succès
        return redirect()->route('interventions.index')->with('success', 'Intervention created successfully');
    }
    

    public function show(Intervention $intervention)
    {
        return view('interventions.show', compact('intervention'));
    }

    public function edit(Intervention $intervention)
    {
        
        return view('interventions.edit', compact('intervention'));
    }

    public function update(UpdateInterventionRequest $request, Intervention $intervention)
    {
        // Valider et récupérer les données du formulaire
        $validatedData = $request->validated();

        // Mettre à jour les données de l'intervention
        $intervention->update($validatedData);

        // Rediriger avec un message de succès
        return redirect()->route('interventions.show', $intervention)->with('success', 'Intervention updated successfully');
    }

    public function destroy(Intervention $intervention)
    {
        // Supprimer l'intervention de la base de données
        $intervention->delete();

        // Rediriger avec un message de succès
        return redirect()->route('interventions.index')->with('success', 'Intervention deleted successfully');
    }

    public function getByCodeIntervention($code)
    {
        // Récupérer l'intervention par code_intervention
        $intervention = Intervention::where('code_intervention', $code)->first();

        if (!$intervention) {
            return response()->json(['error' => 'Intervention not found'], 404);
        }

        return response()->json($intervention);
    }

    public function deleteByCodeIntervention($code)
    {
        // Supprimer l'intervention par code_intervention
        $intervention = Intervention::where('code_intervention', $code)->first();

        if (!$intervention) {
            return response()->json(['error' => 'Intervention not found'], 404);
        }

        $intervention->delete();

        return response()->json(['message' => 'Intervention deleted successfully']);
    }
}
