<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('timetables', function (Blueprint $table) {
            // Supprimer la clé étrangère et la colonne salle_id
            $table->dropForeign(['salle_id']);
            $table->dropColumn('salle_id');

            // Ajouter la colonne salle (string)
            $table->string('salle')->nullable()->after('heure_fin');
        });
    }

    public function down(): void
    {
        Schema::table('timetables', function (Blueprint $table) {
            // Supprimer la colonne salle
            $table->dropColumn('salle');

            // Recréer salle_id et la clé étrangère (si vous avez une table salles)
            $table->foreignId('salle_id')->nullable()->constrained('salles')->onDelete('set null');
        });
    }
};