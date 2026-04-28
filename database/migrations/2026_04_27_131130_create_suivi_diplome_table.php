<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('suivi_diplome', function (Blueprint $table) {
        $table->id('id_suivi');
        $table->enum('etat_diplome', ['en_cours', 'valide', 'delivre', 'annule'])
              ->default('en_cours');
        $table->date('date_demande')->nullable();
        $table->date('date_validation')->nullable();
        $table->date('date_remise')->nullable();
        $table->foreignId('id_diplome')
              ->constrained('diplomes', 'id_diplome')
              ->onDelete('cascade');
        $table->foreignId('id_historique')
              ->nullable()
              ->constrained('historique_diplome', 'id_historique')
              ->onDelete('set null');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suivi_diplome');
    }
};
