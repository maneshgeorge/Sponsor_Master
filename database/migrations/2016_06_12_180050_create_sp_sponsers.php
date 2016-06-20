<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpSponsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('sponsors'))
        {
            Schema::create('sponsors', function(Blueprint $table) {
                $table->increments('sponsor_id');
                $table->integer('company_id');
                $table->date('added_date');
                $table->float('amount_paid');
                $table->integer('customer_id');
                $table->tinyInteger('sponsor_status')->comment = "0: Inactive 1: Active 2: Expired/Resigned";

                $table->index([ 'company_id', 'customer_id', 'sponsor_status'], 'sponsor_index');

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
        Schema::dropIfExists('sponsors');
    }
}
