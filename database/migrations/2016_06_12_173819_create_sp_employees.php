<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('employees'))
        {
            Schema::create('employees', function (Blueprint $table)
            {
                $table->increments('emp_id');
                $table->bigInteger('emp_reg_id');
                $table->integer('customer_id')->comment = "customer_id from customers";
                $table->integer('company_id')->comment = "company_id from companies";
                $table->string('email');
                $table->date('exp_date');
                $table->string('gender', 10);
                $table->date('dob');
                $table->string('designation');
                $table->integer('images_id');
                $table->integer('address_id')->comment = "address_id from address";
                $table->integer('visa_details_id');
                $table->float('salary');
                $table->integer('emp_status')->comment = "0: Inactive 1: Active 2: Expired/Resigned";

                $table->index([ 'emp_reg_id', 'customer_id', 'company_id', 'visa_details_id' ], 'emp_index');
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
        Schema::dropIfExists('employees');
    }
}
