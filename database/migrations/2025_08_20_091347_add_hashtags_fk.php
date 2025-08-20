<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHashtagsFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hashtags', function (Blueprint $table) {
            $table->index('post_id', 'hashtag_post_idx');
            $table->foreign('post_id', 'hashtag_post_fk')->on('posts')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hashtags', function (Blueprint $table) {
            $table->dropIndex('hashtag_post_idx');
            $table->dropForeign('hashtag_post_fk');
        });
    }
}
