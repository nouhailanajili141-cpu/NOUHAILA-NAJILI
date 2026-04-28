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
    Schema::create('etudiants', function (Blueprint $table) {
        $table->id('id_etudiant');
        $table->string('nom');
        $table->string('prenom');
        $table->string('code_apogee')->unique();
        $table->string('filiere');
        $table->foreignId('user_id')
              ->constrained('users')
              ->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
