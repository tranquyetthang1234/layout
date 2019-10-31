<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->text('icon_url')->nullable();
            $table->integer('status')->default(1)->comment('1:active : 0 disable');
            $table->integer('parent_id')->default(0);
            $table->integer('position')->default(1);
            $table->integer('active')->default(1)->comment('1:active , 0 : xóa');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
    }
}
