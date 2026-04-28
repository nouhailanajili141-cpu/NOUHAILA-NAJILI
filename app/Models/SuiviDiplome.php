<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuiviDiplome extends Model
{
    protected $table      = 'suivi_diplome';
    protected $primaryKey = 'id_suivi';

    protected $fillable = [
        'etat_diplome', 'date_demande', 'date_validation',
        'date_remise', 'id_diplome', 'id_historique',
    ];

    public function diplome()
    {
        return $this->belongsTo(Diplome::class, 'id_diplome', 'id_diplome');
    }

    public function historique()
    {
        return $this->belongsTo(HistoriqueDiplome::class, 'id_historique', 'id_historique');
    }
}