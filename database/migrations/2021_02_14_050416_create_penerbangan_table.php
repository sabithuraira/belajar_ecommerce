<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerbanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerbangan', function (Blueprint $table) {
            $table->id();

            $table->string("pesawat");
            $table->integer("bandara_dari");
            $table->integer("bandara_tujuan");
            $table->datetime("waktu_penerbangan");
            $table->integer("status_penerbangan");

            $table->integer("created_by");
            $table->integer("updated_by");

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
        Schema::dropIfExists('penerbangan');
    }
}
