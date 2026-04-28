<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriqueDiplome extends Model
{
    protected $table      = 'historique_diplome';
    protected $primaryKey = 'id_historique';

    protected $fillable = [
        'mention', 'date_retrait', 'id_diplome',
    ];

    public function diplome()
    {
        return $this->belongsTo(Diplome::class, 'id_diplome', 'id_diplome');
    }

    public function suivi()
    {
        return $this->hasOne(SuiviDiplome::class, 'id_historique', 'id_historique');
    }
}