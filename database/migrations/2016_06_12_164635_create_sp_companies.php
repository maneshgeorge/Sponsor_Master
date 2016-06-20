<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('companies'))
        {
            Schema::create('companies', function (Blueprint $table) {
                $table->increments('company_id');
                $table->integer('images_id')->comment = "images_id from table images";
                $table->integer('company_reg_id');
                $table->string('company_name');
                $table->string('address_1');
                $table->string('address_2');
                $table->string('comment');
                $table->integer('cr_no');
                $table->date('cr_date');
                $table->date('cr_exp_date');
                $table->float('fee');
                $table->integer('bank_detail_id')->comment = "Id from bank_details ";
                $table->bigInteger('bank_account_no');
                $table->string('bd_no');
                $table->date('bd_date');
                $table->string('ccn');
                $table->date('ccn_exp_date');
                $table->tinyInteger('company_status')->comment = "0: Active | 1: InActive";
                $table->string('email');
                $table->bigInteger('phone');
                $table->tinyInteger('fee_status')->comment = "0: Not Payed | 1: Payed | 2: Expired";

                $table->index([ 'company_reg_id', 'cr_exp_date' ], 'reg_index');
                $table->index([ 'bank_account_no' ], 'bank_acc_wise_index');
                
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
        Schema::dropIfExists('companies');
    }
}
