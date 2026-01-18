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
        Schema::table('etudiants', function (Blueprint $table) {
            // Ajout de la clé étrangère vers classes.id
            $table->unsignedBigInteger('classe_id')->nullable()->after('id');

            $table->foreign('classe_id')
                  ->references('id')
                  ->on('classes')
                  ->onDelete('set null');  // Si la classe est supprimée → classe_id = null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('etudiants', function (Blueprint $table) {
            $table->dropForeign(['classe_id']);
            $table->dropColumn('classe_id');
        });
    }
};

