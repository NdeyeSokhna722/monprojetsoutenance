<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('events', function (Blueprint $table) {
        // Ajouter la colonne created_by
        $table->foreignId('created_by')->nullable()->constrained('users');
    });
}

public function down()
{
    Schema::table('events', function (Blueprint $table) {
        $table->dropForeign(['created_by']);
        $table->dropColumn('created_by');
    });
}
};
