<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PegawaiGajiMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_fees',function(Blueprint $t){
            $t->string('id',20)->primary();
            $t->unsignedBigInteger('fees_id');
            $t->enum('sudah_digaji',['true','false'])->default('false');
            $t->string('bulan',25)->nullable();
            $t->foreign('fees_id')->references('id')->on('fees');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
