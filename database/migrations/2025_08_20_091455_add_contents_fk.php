<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContentsFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->index('post_id', 'content_post_idx');
            $table->foreign('post_id', 'content_post_fk')->on('posts')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dropIndex('content_post_idx');
            $table->dropForeign('content_post_fk');
        });
    }
}
