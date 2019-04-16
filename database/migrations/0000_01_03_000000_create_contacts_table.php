<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('account_id')->unsigned()->nullable();
            $table->bigInteger('business_type_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->double('discount')->nullable();
            $table->string('phone_number', 25)->nullable();
            $table->string('mobile_phone', 25)->nullable();
            $table->string('skype')->nullable();
            $table->string('fax')->nullable();
            $table->string('website', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('account_id')
                ->references('id')->on('accounts')
                ->onDelete('cascade');
            $table->foreign('business_type_id')
                ->references('id')->on('business_types')
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
        Schema::dropIfExists('contacts');
    }
}
