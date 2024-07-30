<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlternativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternatives', function (Blueprint $table) {
            $table->id();
            $table->string('nama_motor');
            $table->decimal('harga_motor', 10, 2);
            $table->decimal('konsumsi_bbm', 5, 2);
            $table->decimal('biaya_maintenance', 10, 2);
            $table->string('dimensi_motor');
            $table->integer('kapasitas_mesin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alternatives');
    }
}
