<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('entree', function (Blueprint $table) {
            $table->id();
            $table->string('montant')->nullable();
            $table->dateTime('date')->nullable();
            $table->integer('id_utilisateur')->nullable();
            $table->integer('id_candidat')->nullable();
            $table->integer('id_type_paiement')->nullable();
            $table->integer('id_moyen_paiement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entree');
    }
};
