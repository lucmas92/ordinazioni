<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageProductTranslationsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('image_product_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('image_product_id');
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->timestamps();
            $table->auditable();

            $table->unique(['image_product_id', 'locale'], 'img_prod_translations_img_prod_id_locale_unique');
            $table->foreign('image_product_id')->references('id')->on('image_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('image_product_translations');
    }
}
