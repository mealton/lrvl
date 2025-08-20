<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('content_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->text('comment')->nullable();
            $table->unsignedInteger('likes')->default(0);
            $table->boolean('is_reply')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_complained')->default(0);
            $table->string('reason_complaint')->nullable();

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
        Schema::dropIfExists('comments');
    }
}
