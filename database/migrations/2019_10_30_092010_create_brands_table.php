<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200);
            $table->string('logo_url', 200)->nullable();
            $table->string('logo_square_url', 200)->nullable();
            $table->string('banner_url', 200)->nullable();
            $table->string('description', 200)->nullable();
            $table->string('seo_name', 200)->nullable();
            $table->string('meta_description', 200)->nullable();
            $table->string('meta_keywords', 200)->nullable();
            $table->text('story')->nullable();
            $table->enum('status',['Active','Disabled'])->default('Active');
            $table->timestamp('registered_on')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('brands');
    }
}
