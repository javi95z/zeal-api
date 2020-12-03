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
            $table->bigInteger('role_id')->unsigned()->nullable();
            $table->bigInteger('settings_id')->unsigned()->nullable();
            $table->string('email', 100)->unique();
            $table->string('password')->nullable()->default(null);
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->rememberToken();
            $table->boolean('active')->nullable()->default(1);
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->default('');
            $table->string('suffix', 10)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('profile_img')->nullable();
            $table->string('background_img')->nullable();
            $table->boolean('is_admin')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('role_id')
                ->references('id')->on('roles')
                ->onDelete('cascade');
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
