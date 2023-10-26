<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->unsignedBigInteger('id_distribusi');
            $table->date('tanggal_tengat_pembayaran');
            $table->date('tanggal_pembayaran');
            $table->decimal('jumlah_pembayaran', 10);
            $table->enum('metode_pembayaran', ['tunai', 'transfer']);
            $table->timestamps();

            $table->foreign('id_distribusi')->references('id_distribusi')->on('distribusis')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
}