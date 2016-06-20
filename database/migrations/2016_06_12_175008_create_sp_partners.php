<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpPartners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('partners'))
        {
            Schema::create('partners', function (Blueprint $table)
            {
                $table->increments('partner_id');
                $table->integer('images_id');
                $table->integer('partner_reg_id');
                $table->integer('company_id');
                $table->integer('address_id');
                $table->string('email');
                $table->integer('customer_id');
                $table->tinyInteger('partner_status')->comment = "0: Inactive 1: Active 2: Expired/Resigned";
                $table->integer('relation_count')->comment = "Whatever meant by 'par' in table 'partner'";

                $table->index([ 'partner_reg_id', 'company_id', 'customer_id', 'partner_status' ], 'partner_index');

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
        Schema::dropIfExists('partners');
    }
}
