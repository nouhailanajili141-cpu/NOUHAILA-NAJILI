<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diplome extends Model
{
    protected $table      = 'diplomes';
    protected $primaryKey = 'id_diplome';

    protected $fillable = [
        'nom_diplome', 'specialite', 'niveau', 'id_etudiant',
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'id_etudiant', 'id_etudiant');
    }

    public function historiques()
    {
        return $this->hasMany(HistoriqueDiplome::class, 'id_diplome', 'id_diplome');
    }

    public function suivi()
    {
        return $this->hasOne(SuiviDiplome::class, 'id_diplome', 'id_diplome');
    }
}