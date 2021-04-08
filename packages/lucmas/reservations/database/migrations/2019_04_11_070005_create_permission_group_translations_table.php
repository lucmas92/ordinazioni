<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionGroupTranslationsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('permission_group_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('permission_group_id');
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->auditable();

            $table->unique(['permission_group_id', 'locale'], 'permission_group_translations_id_locale_unique'); // rinominato perché troppo lungo
            $table->foreign('permission_group_id')->references('id')->on('permission_group')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('permission_group_translations');
    }
}
