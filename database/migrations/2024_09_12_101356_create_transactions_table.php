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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('motif')->nullable();
            $table->enum('type', ['entree','sortie']);
            $table->integer('id_procedure')->nullable();
            $table->integer('id_moyen_paiement')->nullable();
            $table->string('montant')->nullable();
            $table->string('date')->nullable();
            $table->integer('id_agent')->nullable();
            $table->string('recu')->nullable();
            $table->integer('id_candidat')->nullable();
            $table->integer('id_type_procedure')->nullable();
            $table->integer('id_succursale')->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['0','1'])->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
