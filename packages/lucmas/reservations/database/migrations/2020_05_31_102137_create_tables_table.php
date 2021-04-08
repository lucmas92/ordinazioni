<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Lucmas\Reservations\Seeds\TablesTableSeeder;

class CreateTablesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number')->unique();
            $table->timestamps();
            $table->softDeletes();
            $table->auditableWithDeletes();
        });

        (new TablesTableSeeder())->run();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tables');
    }
}
