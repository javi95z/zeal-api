<?php

use Illuminate\Support\Facades\Schema;
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
            $table->enum('type', ['client', 'employee']);
            $table->string('fullname', 100);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('address')->nullable();
            $table->string('state', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('suffix', 10)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('phone_number', 25)->nullable();
            $table->string('skype', 100)->nullable();
            $table->string('website', 100)->nullable();
            $table->string('profile_picture', 255)->default('default.jpg');
            $table->string('background_picture', 255)->default('default.jpg');
            $table->boolean('is_admin')->default(0);
            $table->timestamps();
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
        Schema::dropIfExists('users');
    }
}
