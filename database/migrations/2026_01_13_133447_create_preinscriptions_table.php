<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('preinscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->enum('genre', ['M', 'F']);
            $table->date('date_naissance');
            $table->string('lieu_naissance')->nullable();
            $table->string('niveau_demande');
            $table->string('parent_nom');
            $table->string('parent_prenom');
            $table->string('email');
            $table->string('telephone');
            $table->string('relation')->nullable();
            $table->string('profession')->nullable();
            $table->text('adresse')->nullable();
            $table->text('message')->nullable();
            $table->boolean('newsletter')->default(false);
            $table->enum('statut', ['en_attente', 'contacte', 'confirme', 'refuse'])->default('en_attente');
            $table->string('numero_dossier')->unique();
            $table->text('notes_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('preinscriptions');
    }
};