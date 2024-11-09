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
        Schema::create('versements', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('type')->nullable();
            $table->integer('id_procedure')->nullable();
            $table->integer('id_moyen_paiement')->nullable();
            $table->string('type_versement')->nullable();
            $table->integer('client_id')->nullable();
            $table->string('client')->nullable();
            $table->string('montant')->nullable();
            $table->string('date')->nullable();
            $table->text('note')->nullable();
            $table->string('recu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('versements');
    }
};
