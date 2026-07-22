<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rencana_anggaran_items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('IDRencanAnggaranItems')->autoIncrement();
            $table->integer('IDRencanaAnggaran');
            $table->integer('IDBantuan');
            $table->integer('IDBarang');
            $table->integer('Jumlah');
            $table->integer('HargaSatuan');
            $table->integer('created_by');
            $table->timestamp('created_at')->useCurrent();
            $table->integer('updated_by');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->integer('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();

            // Foreign Key
            $table->foreign('IDRencanaAnggaran')->references('IDRencanaAnggaran')->on('rencana_anggaran');
            $table->foreign('IDBantuan')->references('IDBantuan')->on('bantuan');
            $table->foreign('IDBarang')->references('IDBarang')->on('barang');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_anggaran_items');
    }
};
