<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('username')->unique();
            $table->string('password');
            $table->string('fullname')->nullable();
            $table->string('email')->unique();
            $table->char('gender')->default('M');
            $table->string('about')->nullable();
            $table->text('profile')->nullable();
            $table->string('profile_image')->nullable();
            $table->timestamp('registration_date');
            $table->boolean('is_admin')->default(0);
            $table->boolean('no_moderate')->default(0);
            $table->boolean('show_erotic')->default(0);
            $table->boolean('show_slider')->default(0);
            $table->boolean('is_active')->default(0);
            $table->boolean('is_banned')->default(0);
            $table->timestamp('banned_date')->nullable();
            $table->unsignedInteger('banned_period')->nullable();
            $table->string('registration_token')->nullable();
            $table->text('liked_publics')->nullable();
            $table->text('liked_comments')->nullable();
            $table->text('history')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
