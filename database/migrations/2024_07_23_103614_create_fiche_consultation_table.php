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
        Schema::create('fiche_consultation', function (Blueprint $table) {
            $table->id();
            $table->string('lien_cv')->nullable();
            $table->integer('id_candidat');
            $table->string('type_visa')->nullable();
            $table->string('reponse1')->nullable();
            $table->string('reponse2')->nullable();
            $table->string('reponse3')->nullable();
            $table->string('reponse4')->nullable();
            $table->string('reponse5')->nullable();
            $table->string('reponse6')->nullable();
            $table->string('reponse7')->nullable();
            $table->string('reponse8')->nullable();
            $table->string('reponse9')->nullable();
            $table->string('reponse10')->nullable();
            $table->string('reponse11')->nullable();
            $table->string('reponse12')->nullable();
            $table->string('reponse13')->nullable();
            $table->string('reponse14')->nullable();
            $table->string('reponse15')->nullable();
            $table->string('reponse16')->nullable();
            $table->string('reponse17')->nullable();
            $table->string('reponse18')->nullable();
            $table->string('reponse19')->nullable();
            $table->string('reponse20')->nullable();
            $table->string('reponse21')->nullable();
            $table->string('reponse22')->nullable();
            $table->string('reponse23')->nullable();
            $table->string('reponse24')->nullable();
            $table->string('reponse25')->nullable();
            $table->string('reponse26')->nullable();
            $table->string('reponse27')->nullable();
            $table->string('reponse28')->nullable();
            $table->string('reponse29')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiche_consultation');
    }
};
