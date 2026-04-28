<?php
namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{
    // عرض قائمة الطلاب
    public function index()
    {
        $etudiants = Etudiant::with('user')->get();
        return view('administration.etudiants.index', compact('etudiants'));
    }

    // عرض فورم إضافة طالب
    public function create()
    {
        return view('administration.etudiants.create');
    }

    // حفظ طالب جديد
    public function store(Request $request)
    {
        $request->validate([
            'nom'         => 'required|string|max:100',
            'prenom'      => 'required|string|max:100',
            'code_apogee' => 'required|string|unique:etudiants,code_apogee',
            'cne'         => 'required|string|unique:etudiants,cne',
            'filiere'     => 'required|string|max:100',
            'email'       => 'required|email|unique:users,email',
        ], [
            'nom.required'         => 'Le nom est obligatoire.',
            'prenom.required'      => 'Le prénom est obligatoire.',
            'code_apogee.required' => 'Le Code Apogée est obligatoire.',
            'code_apogee.unique'   => 'Ce Code Apogée existe déjà.',
            'cne.required'         => 'Le CNE est obligatoire.',
            'cne.unique'           => 'Ce CNE existe déjà.',
            'filiere.required'     => 'La filière est obligatoire.',
            'email.required'       => 'L\'email est obligatoire.',
            'email.unique'         => 'Cet email existe déjà.',
        ]);

        // إنشاء حساب user للطالب
        $user = User::create([
            'name'     => $request->nom . ' ' . $request->prenom,
            'email'    => $request->email,
            'password' => Hash::make($request->code_apogee),
            'role'     => 'etudiant',
        ]);

        // إنشاء الطالب
        Etudiant::create([
            'nom'         => $request->nom,
            'prenom'      => $request->prenom,
            'code_apogee' => $request->code_apogee,
            'cne'         => $request->cne,
            'filiere'     => $request->filiere,
            'user_id'     => $user->id,
        ]);

        return redirect()->route('administration.etudiants.index')
                         ->with('success', 'Étudiant ajouté avec succès.');
    }

    // عرض فورم تعديل طالب
    public function edit($id)
    {
        $etudiant = Etudiant::with('user')->findOrFail($id);
        return view('administration.etudiants.edit', compact('etudiant'));
    }

    // تحديث بيانات طالب
    public function update(Request $request, $id)
    {
        $etudiant = Etudiant::with('user')->findOrFail($id);

        $request->validate([
            'nom'         => 'required|string|max:100',
            'prenom'      => 'required|string|max:100',
            'code_apogee' => 'required|string|unique:etudiants,code_apogee,' . $etudiant->id_etudiant . ',id_etudiant',
            'cne'         => 'required|string|unique:etudiants,cne,' . $etudiant->id_etudiant . ',id_etudiant',
            'filiere'     => 'required|string|max:100',
            'email'       => 'required|email|unique:users,email,' . $etudiant->user->id,
        ], [
            'nom.required'         => 'Le nom est obligatoire.',
            'prenom.required'      => 'Le prénom est obligatoire.',
            'code_apogee.required' => 'Le Code Apogée est obligatoire.',
            'code_apogee.unique'   => 'Ce Code Apogée existe déjà.',
            'cne.required'         => 'Le CNE est obligatoire.',
            'cne.unique'           => 'Ce CNE existe déjà.',
            'filiere.required'     => 'La filière est obligatoire.',
            'email.required'       => 'L\'email est obligatoire.',
            'email.unique'         => 'Cet email existe déjà.',
        ]);

        // تحديث بيانات الطالب
        $etudiant->update([
            'nom'         => $request->nom,
            'prenom'      => $request->prenom,
            'code_apogee' => $request->code_apogee,
            'cne'         => $request->cne,
            'filiere'     => $request->filiere,
        ]);

        // تحديث بيانات الـ user
        $etudiant->user->update([
            'name'     => $request->nom . ' ' . $request->prenom,
            'email'    => $request->email,
            'password' => Hash::make($request->code_apogee),
        ]);

        return redirect()->route('administration.etudiants.index')
                         ->with('success', 'Étudiant modifié avec succès.');
    }

    // حذف طالب
    public function destroy($id)
    {
        $etudiant = Etudiant::with('user')->findOrFail($id);

        // حذف الـ user أولاً ثم الطالب
        $etudiant->user->delete();
        $etudiant->delete();

        return redirect()->route('administration.etudiants.index')
                         ->with('success', 'Étudiant supprimé avec succès.');
    }
}