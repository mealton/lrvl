<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('post_id');
            $table->string('type');
            $table->text('content');
            $table->string('style')->nullable();
            $table->string('source')->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('description')->nullable();
            $table->text('text')->nullable();
            $table->string('token')->nullable();
            $table->boolean('is_hidden')->default(0);
            $table->string('poster')->nullable();
            $table->unsignedInteger('content_likes')->default(0);
            $table->text('users_liked')->nullable();

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
        Schema::dropIfExists('contents');
    }
}
