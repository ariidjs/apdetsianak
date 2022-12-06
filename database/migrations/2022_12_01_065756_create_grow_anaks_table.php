<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrowAnaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grow_anaks', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('tgl_ukur');
            $table->string('tmpt_ukur');
            $table->string('tinggi');
            $table->string('berat');
            $table->string('lingkar_kepala')->nullable();
            $table->string('lingkar_lengan');
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
        Schema::dropIfExists('grow_anaks');
    }
}
