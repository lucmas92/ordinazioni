<?php

use Lucmas\Reservations\Seeds\PermissionGroupTableSeeder;
use Lucmas\Reservations\Seeds\PermissionsTableSeeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTranslationsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('permission_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('permission_id');
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->auditable();

            $table->unique(['permission_id', 'locale']);
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });
        (new PermissionGroupTableSeeder())->run();
        (new PermissionsTableSeeder())->run();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('permission_translations');
    }
}
