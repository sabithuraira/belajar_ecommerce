<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_barang', function (Blueprint $table) {
            $table->id();
            
            $table->integer("id_invoice");
            $table->integer("id_barang");
            $table->integer("id_customer");
            $table->integer("jumlah_barang");
            $table->decimal("jumlah_harga",9,2);
            
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
        Schema::dropIfExists('invoice_barang');
    }
}
