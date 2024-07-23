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
        Schema::create('statut_par_type_procedure', function (Blueprint $table) {
            $table->id();
            $table->string('label')->nullable();
            $table->integer('id_statut_procedure');
            $table->integer('id_type_procedure');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statut_par_type_procedure');
    }
};
