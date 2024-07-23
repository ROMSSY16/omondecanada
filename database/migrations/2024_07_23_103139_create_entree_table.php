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
        Schema::create('entree', function (Blueprint $table) {
            $table->id();
            $table->string('montant')->nullable();
            $table->dateTime('date')->nullable();
            $table->integer('id_utilisateur');
            $table->integer('id_candidat');
            $table->integer('id_type_paiement');
            $table->integer('id_moyen_paiement');
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
