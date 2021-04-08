<?php

use Lucmas\Reservations\Seeds\UsersTableSeeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->string('username')->unique();
            $table->softDeletes();
            $table->auditableWithDeletes();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        (new UsersTableSeeder())->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role_id');
            $table->dropColumn('username');
            $table->dropColumn('api_token');
            $table->dropColumn('deleted_at');
        });
    }
}
