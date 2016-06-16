<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('city');
            $table->string('email')->unique();
            $table->string('role')->default('contributor');
            $table->string('notify_frequency')->default('Weekly');
            $table->timestamp('last_notified')->default('1900-01-01');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // Pivot table to connect orgs and users
        Schema::create('org_user', function (Blueprint $table) {
            $table->integer('org_id')->unsigned()->index();
            $table->foreign('org_id')->references('id')->on('orgs')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('org_role')->default('contributor');
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
        Schema::drop('org_user');
        Schema::drop('users');
    }
}
