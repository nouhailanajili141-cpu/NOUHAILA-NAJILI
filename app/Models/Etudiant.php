<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $table      = 'etudiants';
    protected $primaryKey = 'id_etudiant';

    protected $fillable = [
        'nom', 'prenom', 'code_apogee', 'cne', 'filiere', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function diplomes()
    {
        return $this->hasMany(Diplome::class, 'id_etudiant', 'id_etudiant');
    }
}