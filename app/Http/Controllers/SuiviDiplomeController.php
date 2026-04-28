<?php
namespace App\Http\Controllers;

use App\Models\SuiviDiplome;
use App\Models\Diplome;
use App\Models\HistoriqueDiplome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuiviDiplomeController extends Controller
{
    // عرض قائمة السويفي
    public function index()
    {
        $suivis = SuiviDiplome::with('diplome.etudiant')->get();
        return view('administration.suivi.index', compact('suivis'));
    }

    // عرض فورم Validation
    public function create()
    {
        // نعرض غير الدبلومات اللي ما عندهاش سويفي
        $diplomes = Diplome::with('etudiant')
                        ->doesntHave('suivi')
                        ->get();
        return view('administration.suivi.create', compact('diplomes'));
    }

    // Validation — ينشئ Suivi تلقائياً إذا valide
    public function store(Request $request)
    {
        $request->validate([
            'id_diplome'      => 'required|exists:diplomes,id_diplome',
            'decision'        => 'required|in:valide,annule',
            'date_demande'    => 'required|date',
            'date_validation' => 'required|date',
            'mention'         => 'nullable|string|max:100',
        ]);

        if ($request->decision === 'valide') {
            // إنشاء Historique
            $historique = HistoriqueDiplome::create([
                'mention'      => $request->mention ?? null,
                'date_retrait' => null,
                'id_diplome'   => $request->id_diplome,
            ]);

            // إنشاء Suivi تلقائياً
            SuiviDiplome::create([
                'etat_diplome'    => 'valide',
                'date_demande'    => $request->date_demande,
                'date_validation' => $request->date_validation,
                'date_remise'     => null,
                'id_diplome'      => $request->id_diplome,
                'id_historique'   => $historique->id_historique,
            ]);

        } else {
            // annulé ──➜ ننشئ Suivi بحالة annulé فقط
            SuiviDiplome::create([
                'etat_diplome'    => 'annule',
                'date_demande'    => $request->date_demande,
                'date_validation' => $request->date_validation,
                'date_remise'     => null,
                'id_diplome'      => $request->id_diplome,
                'id_historique'   => null,
            ]);
        }

        return redirect()->route('administration.suivi.index')
                         ->with('success', 'Validation effectuée avec succès.');
    }

    // Livraison
    public function livrer(Request $request, $id)
    {
        $request->validate([
            'date_remise' => 'required|date',
        ]);

        $suivi = SuiviDiplome::findOrFail($id);

        $suivi->update([
            'etat_diplome' => 'delivre',
            'date_remise'  => $request->date_remise,
        ]);

        if ($suivi->id_historique) {
            HistoriqueDiplome::findOrFail($suivi->id_historique)
                ->update(['date_retrait' => $request->date_remise]);
        }

        return redirect()->route('administration.suivi.index')
                         ->with('success', 'Diplôme livré avec succès.');
    }

    // عرض سويفي الطالب
    public function consulter()
    {
        $etudiant = Auth::user()->etudiant;
        $suivi    = SuiviDiplome::with('diplome', 'historique')
                        ->whereHas('diplome', function ($q) use ($etudiant) {
                            $q->where('id_etudiant', $etudiant->id_etudiant);
                        })->first();

        return view('etudiant.suivi', compact('suivi'));
    }
}