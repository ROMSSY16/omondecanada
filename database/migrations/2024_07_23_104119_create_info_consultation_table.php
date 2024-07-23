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
        Schema::create('info_consultation', function (Blueprint $table) {
            $table->id();
            $table->string('label')->nullable();
            $table->string('lien_zoom')->nullable();
            $table->string('lien_zoom_demarrer')->nullable();
            $table->dateTime('date_heure')->nullable();
            $table->string('nombre_candidats')->nullable();
            $table->integer('id_consultante');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_consultation');
    }
};
