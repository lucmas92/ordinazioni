<?php

use Lucmas\Reservations\Seeds\RolesTableSeeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTranslationsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('role_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_id');
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->auditable();

            $table->unique(['role_id', 'locale']);
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
        (new RolesTableSeeder())->run();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('role_translations');
    }
}
