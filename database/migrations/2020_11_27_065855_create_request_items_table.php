<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_items', function (Blueprint $table) {
            $table->id();
            // $table->string('subgroup');
            // $table->string('item');

            $table->bigInteger('service_id');
            $table->bigInteger('product_id');
            $table->string('item')->nullable();
            $table->text('specification');
            $table->string('piroirty', 10)->nullable();
            $table->integer('qtreqtopur');
            $table->integer('qtonstore')->nullable();
            $table->integer('acqtreqtopur');
            $table->string('currency', 10)->nullable();
            $table->string('unit', 10)->nullable();
            $table->integer('budget')->nullable();
            $table->string('rowbudget')->nullable();
            // $table->string('sumoftotalrowbudget')->nullable();
            // $table->bigInteger('sumoftotalbudget');

            $table->integer('pr_request_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_items');
    }
}
