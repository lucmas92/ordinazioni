<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Lucmas\Reservations\Seeds\TablesTableSeeder;

class CreateOrdersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number')->unique();
            $table->unsignedBigInteger('table_id');
            $table->enum('status',['OPEN','CLOSE'])->default('OPEN');
            $table->timestamps();
            $table->softDeletes();
            $table->auditableWithDeletes();

            $table->foreign('table_id')->references('id')->on('tables');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('orders');
    }
}
