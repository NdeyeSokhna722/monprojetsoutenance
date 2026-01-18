<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('timetables', function (Blueprint $table) {
            // Ajouter la colonne type si elle n'existe pas
            if (!Schema::hasColumn('timetables', 'type')) {
                $table->enum('type', ['Cours', 'TD', 'TP', 'Examen', 'Autre'])->default('Cours')->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('timetables', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};