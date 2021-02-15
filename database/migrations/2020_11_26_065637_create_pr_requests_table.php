<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_requests', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('request_number')->nullable();
            $table->bigInteger('main_group_id');
            $table->string('department');
            $table->string('project')->nullable();;
            $table->string('site')->nullable();;
            $table->string('group')->nullable();;
            $table->string('user_location');

            $table->integer('user_id');


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
        Schema::dropIfExists('pr_requests');
    }
}
