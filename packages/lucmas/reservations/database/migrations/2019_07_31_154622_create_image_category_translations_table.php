<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageCategoryTranslationsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('image_category_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('image_category_id');
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->timestamps();
            $table->auditable();

            $table->unique(['image_category_id', 'locale'], 'cat_img_translations_cat_img_id_locale_unique');
            $table->foreign('image_category_id')->references('id')->on('image_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('image_category_translations');
    }
}
