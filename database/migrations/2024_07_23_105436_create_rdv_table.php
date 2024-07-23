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
        Schema::create('rdv', function (Blueprint $table) {
            $table->id();
            $table->date('date_rdv')->nullable();
            $table->integer('candidat_id');
            $table->integer('commercial_id');
            $table->dateTime('date_enregistrement_appel')->nullable();
            $table->enum('rdv_effectue', ['0','1'])->nullable()->default(0);
            $table->enum('consultation_payee', ['0','1'])->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rdv');
    }
};
