<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostsFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->index('user_id', 'post_user_idx');
            $table->foreign('user_id', 'post_user_fk')->on('users')->references('id');

            $table->index('category_id', 'post_category_idx');
            $table->foreign('category_id', 'post_category_fk')->on('categories')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex('post_user_idx');
            $table->dropForeign('post_user_fk');

            $table->dropIndex('post_category_idx');
            $table->dropForeign('post_category_fk');
        });
    }
}
