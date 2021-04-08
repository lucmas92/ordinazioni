<?php

use Lucmas\Reservations\Seeds\SidebarItemSeeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSidebarItemTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sidebar_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->nullable();
            $table->string('name');
            $table->string('route')->nullable();
            $table->string('position');
            $table->string('icon')->nullable();
            $table->string('permission')->nullable();

            $table->index(['parent_id', 'name']);
        });

        (new SidebarItemSeeder())->run();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('sidebar_item');
    }
}
