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
            $table->id();
            $table->timestamps();

            $table->string('title');
            $table->text('introtext')->nullable();
            $table->string('image_default')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_published')->default(1);
            $table->string('source_url')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedInteger('views')->default(0);
            $table->unsignedInteger('likes')->default(0);
            $table->boolean('like_content')->default(0);
            $table->string('alias');
            $table->string('token')->nullable();
            $table->string('comment')->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->boolean('moderated')->default(0);
            $table->boolean('subscribers_notification')->default(1);
            $table->timestamp('published_date')->nullable();

            $table->softDeletes();
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
