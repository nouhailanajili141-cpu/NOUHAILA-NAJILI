<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Etudiant;

class AuthController extends Controller
{
    // ─── Login Administration / Administrateur ───
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'L\'adresse email est obligatoire.',
            'email.email'       => 'L\'adresse email n\'est pas valide.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return back()->withErrors([
                'email' => 'Email ou mot de passe incorrect.',
            ]);
        }

        $user = Auth::user();

        return match($user->role) {
            'administration' => redirect()->route('administration.dashboard'),
            'administrateur' => redirect()->route('administrateur.dashboard'),
            default          => redirect('/'),
        };
    }

    // ─── Login Etudiant (CNE + code_apogee) ─────
    public function showLoginEtudiant()
    {
        return view('auth.login-etudiant');
    }

    public function loginEtudiant(Request $request)
    {
        $request->validate([
            'cne'         => 'required|string',
            'code_apogee' => 'required|string',
        ], [
            'cne.required'         => 'Le CNE est obligatoire.',
            'code_apogee.required' => 'Le Code Apogée est obligatoire.',
        ]);

        $etudiant = Etudiant::where('cne', $request->cne)->first();

        if (!$etudiant) {
            return back()->withErrors([
                'cne' => 'CNE incorrect.',
            ]);
        }

        $user = $etudiant->user;

        if (!Hash::check($request->code_apogee, $user->password)) {
            return back()->withErrors([
                'code_apogee' => 'Code Apogée incorrect.',
            ]);
        }

        Auth::login($user);

        return redirect()->route('etudiant.dashboard');
    }

    // ─── Logout ──────────────────────────────────
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}