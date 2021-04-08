<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('filename');
            $table->string('filename_original');
            $table->string('extension');
            $table->string('mime_type');
            $table->integer('size');
            $table->string('hash');
            $table->timestamps();
            $table->softDeletes();
            $table->auditableWithDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('files');
    }
}
