<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_consultation_records_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('consultation_records', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultation_records');
    }
}
