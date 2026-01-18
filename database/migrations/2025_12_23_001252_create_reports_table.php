<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type'); // students, teachers, attendance, grades, financial, custom
            $table->string('format'); // pdf, excel, html
            $table->json('parameters')->nullable(); // Filtres utilisés
            $table->json('data')->nullable(); // Données du rapport
            $table->string('file_path')->nullable(); // Chemin du fichier généré
            $table->string('file_name')->nullable();
            $table->integer('file_size')->nullable();
            
            // Relations
            $table->foreignId('generated_by')->constrained('users');
            $table->foreignId('classe_id')->nullable()->constrained();
            
            $table->timestamp('generated_at')->useCurrent();
            $table->timestamp('downloaded_at')->nullable();
            $table->integer('download_count')->default(0);
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
};