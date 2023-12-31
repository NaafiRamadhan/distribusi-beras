<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistribusisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribusis', function (Blueprint $table) {
            $table->id('id_distribusi');
            $table->char('id_toko',30);
            $table->char('kode_distribusi');
            $table->date('tanggal_distribusi');
            $table->integer('jumlah_distribusi');
            $table->integer('total_harga');
            $table->string('sales');
            $table->enum('status', ['Pending', 'Terkirim']);
            $table->enum('status_bayar', ['Lunas', 'Belum-Lunas']);
            $table->timestamps();

            $table->foreign('id_toko')->references('id_toko')->on('tokos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distributions');
    }
}
