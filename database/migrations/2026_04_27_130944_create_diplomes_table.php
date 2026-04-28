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
    Schema::create('diplomes', function (Blueprint $table) {
        $table->id('id_diplome');
        $table->string('nom_diplome');
        $table->string('specialite');
        $table->string('niveau');
        $table->foreignId('id_etudiant')
              ->constrained('etudiants', 'id_etudiant')
              ->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diplomes');
    }
};
