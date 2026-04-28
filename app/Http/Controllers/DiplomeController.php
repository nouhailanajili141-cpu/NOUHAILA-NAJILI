<?php
namespace App\Http\Controllers;

use App\Models\Diplome;
use App\Models\Etudiant;
use Illuminate\Http\Request;

class DiplomeController extends Controller
{
    public function index()
    {
        $diplomes = Diplome::with('etudiant')->get();
        return view('administration.diplomes.index', compact('diplomes'));
    }

    public function create()
    {
        $etudiants = Etudiant::all();
        return view('administration.diplomes.create', compact('etudiants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_diplome' => 'required|string|max:150',
            'specialite'  => 'required|string|max:150',
            'niveau'      => 'required|string|max:50',
            'id_etudiant' => 'required|exists:etudiants,id_etudiant',
        ]);

        Diplome::create($request->all());

        return redirect()->route('administration.diplomes.index')
                         ->with('success', 'Diplôme ajouté avec succès.');
    }

    public function edit($id)
    {
        $diplome   = Diplome::findOrFail($id);
        $etudiants = Etudiant::all();
        return view('administration.diplomes.edit', compact('diplome', 'etudiants'));
    }

    public function update(Request $request, $id)
    {
        $diplome = Diplome::findOrFail($id);

        $request->validate([
            'nom_diplome' => 'required|string|max:150',
            'specialite'  => 'required|string|max:150',
            'niveau'      => 'required|string|max:50',
        ]);

        $diplome->update($request->all());

        return redirect()->route('administration.diplomes.index')
                         ->with('success', 'Diplôme modifié avec succès.');
    }

    public function destroy($id)
    {
        Diplome::findOrFail($id)->delete();

        return redirect()->route('administration.diplomes.index')
                         ->with('success', 'Diplôme supprimé avec succès.');
    }
}