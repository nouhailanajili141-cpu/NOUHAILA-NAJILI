<?php
namespace App\Http\Controllers;

use App\Models\HistoriqueDiplome;
use Illuminate\Support\Facades\Auth;

class HistoriqueController extends Controller
{
    public function index()
    {
        $historiques = HistoriqueDiplome::with('diplome.etudiant')->get();
        return view('administration.historique.index', compact('historiques'));
    }

    public function consulter()
    {
        $etudiant    = Auth::user()->etudiant;
        $historiques = HistoriqueDiplome::with('diplome')
                        ->whereHas('diplome', function ($q) use ($etudiant) {
                            $q->where('id_etudiant', $etudiant->id_etudiant);
                        })->get();

        return view('etudiant.historique', compact('historiques'));
    }
}