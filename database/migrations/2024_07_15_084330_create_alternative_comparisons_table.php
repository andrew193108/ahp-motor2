<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlternativeComparisonsTable extends Migration
{
    public function up()
    {
        Schema::create('alternative_comparisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criteria_id')->constrained()->onDelete('cascade');
            $table->foreignId('alternative_id_1')->constrained('alternatives')->onDelete('cascade');
            $table->foreignId('alternative_id_2')->constrained('alternatives')->onDelete('cascade');
            $table->float('value');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alternative_comparisons');
    }
}
