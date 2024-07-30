<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePairwiseComparisonsTable extends Migration
{
    public function up()
    {
        Schema::create('pairwise_comparisons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('criteria1_id');
            $table->unsignedBigInteger('criteria2_id');
            $table->float('value');
            $table->timestamps();

            $table->foreign('criteria1_id')->references('id')->on('criterias')->onDelete('cascade');
            $table->foreign('criteria2_id')->references('id')->on('criterias')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pairwise_comparisons');
    }
}
