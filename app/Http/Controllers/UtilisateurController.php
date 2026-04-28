<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    public function index()
    {
        $utilisateurs = User::all();
        return view('administrateur.utilisateurs.index', compact('utilisateurs'));
    }

    public function create()
    {
        return view('administrateur.utilisateurs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:etudiant,administration,administrateur',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('administrateur.utilisateurs.index')
                         ->with('success', 'Utilisateur ajouté avec succès.');
    }

    public function edit($id)
    {
        $utilisateur = User::findOrFail($id);
        return view('administrateur.utilisateurs.edit', compact('utilisateur'));
    }

    public function update(Request $request, $id)
    {
        $utilisateur = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'role' => 'required|in:etudiant,administration,administrateur',
        ]);

        $utilisateur->update([
            'name' => $request->name,
            'role' => $request->role,
        ]);

        return redirect()->route('administrateur.utilisateurs.index')
                         ->with('success', 'Utilisateur modifié avec succès.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('administrateur.utilisateurs.index')
                         ->with('success', 'Utilisateur supprimé avec succès.');
    }
}