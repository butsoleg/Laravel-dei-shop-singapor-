<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cc_id');
            $table->string('name');
            $table->string('image_url', 200)->nullable();
            $table->string('banner_url', 200)->nullable();
            $table->string('icon_url', 200)->nullable();
            $table->string('description', 200)->nullable();
            $table->integer('parent_category')->default(0);
            $table->string('meta_description', 200)->nullable();
            $table->string('search_words', 250)->nullable();
            $table->integer('age_restricted')->default(0);
            $table->enum('status',['Active','Disabled'])->default('Active');
            $table->integer('order')->nullable();
            $table->timestamp('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('last_updated')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
