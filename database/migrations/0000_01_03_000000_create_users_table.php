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
            $table->bigIncrements('id');
            $table->bigInteger('settings_id')->unsigned()->nullable();
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('active');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('suffix', 10)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('profile_img')->default('default.jpg');
            $table->string('background_img')->default('default.jpg');
            $table->boolean('is_admin')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('settings_id')
                ->references('id')->on('settings')
                ->onDelete('cascade');
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
