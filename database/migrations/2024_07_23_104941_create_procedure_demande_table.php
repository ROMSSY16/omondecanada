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
        Schema::create('procedure_demande', function (Blueprint $table) {
            $table->id();
            $table->integer('id_candidat');
            $table->integer('id_type_procedure');
            $table->integer('statut_id');
            $table->integer('consultante_id');
            $table->integer('tag_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedure_demande');
    }
};
