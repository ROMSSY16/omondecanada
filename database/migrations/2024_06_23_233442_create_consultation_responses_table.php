<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_consultation_responses_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationResponsesTable extends Migration
{
    public function up()
    {
        Schema::create('consultation_responses', function (Blueprint $table) {
            $table->id();
            $table->integer('consultation_record_id');
            $table->integer('question_id');
            $table->text('response');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultation_responses');
    }
}
