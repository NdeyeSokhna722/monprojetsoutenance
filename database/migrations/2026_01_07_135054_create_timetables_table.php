<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classe_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('matiere_id')->constrained('matieres')->onDelete('cascade');
            $table->foreignId('enseignant_id')->constrained('enseignants')->onDelete('cascade');
            $table->enum('jour', ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche']);
            $table->time('heure_debut');
            $table->time('heure_fin');
          $table->string('salle')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['Cours', 'TD', 'TP', 'Examen', 'Autre'])->default('Cours'); // Cette ligne doit exister
            $table->timestamps();
            
            // Index pour optimiser les requêtes
            $table->index(['classe_id', 'jour']);
            $table->index(['enseignant_id', 'jour']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timetables');
    }
};