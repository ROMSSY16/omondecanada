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
        Schema::create('candidat', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('numero_telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('profession')->nullable();
            $table->date('date_naissance')->nullable();
            $table->enum('consultation_payee', ['0','1'])->nullable()->default(0);
            $table->enum('consultation_effectuee', ['0','1'])->nullable()->default(0);
            $table->enum('versement_effectuee', ['0','1'])->nullable()->default(0);
            $table->dateTime('date_enregistrement')->nullable();
            $table->text('remarque_consultante')->nullable();
            $table->text('remarque_agent')->nullable();
            $table->string('ville')->nullable();
            $table->string('pays')->nullable();
            $table->date('date_rdv')->nullable();
            $table->integer('id_utilisateur');
            $table->integer('id_info_consultation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidat');
    }
};
