<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentsFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->index('post_id', 'comment_post_idx');
            $table->foreign('post_id', 'comment_post_fk')->on('posts')->references('id');

            $table->index('content_id', 'comment_content_idx');
            $table->foreign('content_id', 'comment_content_fk')->on('contents')->references('id');

            $table->index('user_id', 'comment_user_idx');
            $table->foreign('user_id', 'comment_user_fk')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropIndex('comment_post_idx');
            $table->dropForeign('comment_post_fk');

            $table->dropIndex('comment_content_idx');
            $table->dropForeign('comment_content_fk');

            $table->dropIndex('comment_user_idx');
            $table->dropForeign('comment_user_fk');
        });
    }
}
