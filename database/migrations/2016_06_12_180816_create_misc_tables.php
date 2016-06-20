<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiscTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('bank_details'))
        {
            Schema::create('bank_details', function (Blueprint $table) {
                $table->increments('bank_detail_id');
                $table->string('bank_name');
                $table->string('bank_branch_name');
                $table->string('branch_ifsc_code', 150);
                $table->bigInteger('branch_phone');
                $table->string('address_id');

            });

        }
        if (!Schema::hasTable('visa_details'))
        {
            Schema::create('visa_details', function (Blueprint $table) {
                $table->increments('visa_details_id');
                $table->string('visa_id');
                $table->date('issued_date');
                $table->date('exp_date');
            });

        }
        if (!Schema::hasTable('address'))
        {
            Schema::create('address', function (Blueprint $table) {
                $table->increments('address_id');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('address_line_1');
                $table->string('address_line_2');
                $table->string('city');
                $table->string('state');
                $table->string('country');
                $table->string('zip');
            });

        }
        if (!Schema::hasTable('countries'))
        {
            Schema::create('countries', function (Blueprint $table) {
                $table->increments('country_id');
                $table->string('name');
                $table->string('iso', 10);
                $table->string('iso3', 10);
                $table->tinyInteger('num_code');
                $table->tinyInteger('phone_code');
            });

        }
        if (!Schema::hasTable('events'))
        {
            Schema::create('events', function (Blueprint $table) {
                $table->increments('event_id');
                $table->string('event_name');
                $table->dateTime('added_date');
                $table->dateTime('scheduled_time');
                $table->string('title');
                $table->string('comment');
                $table->integer('customer_id');
                $table->integer('company_id');
                $table->tinyInteger('event_status')->comment = "0: Incomplete/Yet to happen 1: Completed 2: Re-scheduled";

                $table->index([ 'customer_id', 'company_id', 'event_status' ], 'event_index');
            });

        }
        if (!Schema::hasTable('images'))
        {
            Schema::create('images', function (Blueprint $table) {
                $table->increments('id');
                $table->bigInteger('images_id')->comment = "UNIX_TIMESTAMP()";
                $table->string('image_name');
                $table->tinyInteger('image_type')->comment = "1: profile pic 2: visa pic 3: registration copy 4: other";
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_details');
        Schema::dropIfExists('visa_details');
        Schema::dropIfExists('address');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('events');
        Schema::dropIfExists('images');
    }
}
