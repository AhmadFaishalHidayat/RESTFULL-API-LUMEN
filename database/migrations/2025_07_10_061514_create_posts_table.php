<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->unsignedInteger('category_id'); // wajib punya category_id
            $table->unsignedInteger('user_id'); // wajib punya user_id
            $table->string('title');
            $table->text('content');
            $table->timestamps();
            $table->softDeletes();
            // Menambahkan foreign key untuk category_id
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // Menambahkan foreign key untuk user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
