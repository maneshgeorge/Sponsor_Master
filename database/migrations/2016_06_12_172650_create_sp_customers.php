<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('customers'))
        {
            Schema::create('customers', function (Blueprint $table)
            {
                $table->increments('customer_id');
                $table->string('first_name', 150);
                $table->string('last_name', 150);
                $table->string('address_line_1');
                $table->string('address_line_2');
                $table->string('email');
                $table->bigInteger('phone');
                $table->integer('images_id')->comment = "images_id from table images";
                $table->integer('country_id')->comment = "country_id from countries";
                $table->string('office_address');
                $table->date('issue_date');
                $table->date('exp_date');
                $table->integer('customer_status')->comment = "0: Inactive | 1: Active | 2: Expired/Resigned";
                $table->string('user_name');
                $table->string('password')->comment = "md5('secret' . password)";
                $table->tinyInteger('privilege_level')->comment = "0: Customer user | 1: Admin user";

                $table->index([ 'email', 'user_name', 'privilege_level', 'exp_date' ], 'check_customer_index');

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
        Schema::dropIfExists('customers');
    }
}
