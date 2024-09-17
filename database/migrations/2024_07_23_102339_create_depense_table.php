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
        Schema::create('depense', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('type_depense')->nullable();
            $table->integer('id_moyen_paiement')->nullable();
            $table->string('montant')->nullable();
            $table->string('recu')->nullable();
            $table->integer('id_agent')->nullable();
            $table->dateTime('date')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depense');
    }
};
