<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentitasAnaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identitas_anaks', function (Blueprint $table) {
            $table->id();
            $table->string("no_kk");
            $table->string("nik")->unique();
            $table->string("nama");
            $table->smallInteger("j_kelamin");
            $table->string("ttl");
            $table->string("umur");
            $table->string("alamat");
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
        Schema::dropIfExists('identitas_anaks');
    }
}
