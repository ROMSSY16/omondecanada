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
        Schema::create('succursale', function (Blueprint $table) {
            $table->id();
            $table->string('label')->nullable();
            $table->string('montant')->nullable();
            $table->string('devis')->nullable();
            $table->enum('status', ['0','1'])->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('succursale');
    }
};
