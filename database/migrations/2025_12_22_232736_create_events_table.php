<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('start');  // Nom original
            $table->dateTime('end')->nullable();  // Nom original
            $table->enum('type', ['cours', 'examen', 'réunion', 'événement', 'vacances', 'autre'])->default('cours');
            $table->string('color')->default('#3b82f6');
            $table->boolean('is_public')->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->index(['start', 'end']);
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};