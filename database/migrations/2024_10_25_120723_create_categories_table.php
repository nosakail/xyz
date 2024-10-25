<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Ajout de la colonne category_id à la table tracks
        Schema::table('tracks', function (Blueprint $table) {
            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('tracks', function (Blueprint $table) {
            $table->dropForeignIdFor('category_id');
        });
        Schema::dropIfExists('categories');
    }
};
