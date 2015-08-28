<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('avatar');
            $table->string('email')->nullable();
            $table->string('password', 60);
            $table->string('telp')->nullable();
            $table->enum('gender', ['pria', 'wanita']);
            $table->date('dob')->nullable();
            $table->boolean('is_admin');

            $table->string('sso_twitter_id', 60);
            $table->text('sso_twitter_data');
            $table->timestamp('sso_twitter_updated_at');

            $table->string('sso_facebook_id', 60);
            $table->text('sso_facebook_data');
            $table->timestamp('sso_facebook_updated_at');

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['deleted_at', 'email']);
            $table->index(['deleted_at', 'sso_twitter_id']);
            $table->index(['deleted_at', 'sso_facebook_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
