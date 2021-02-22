<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_groups', function (Blueprint $table) {
            $table->id();
            $table->string('group_name');

            $table->bigInteger('approval_cycle_id')->unsigned();
            $table->foreign('approval_cycle_id')->references('id')->on('approvals')->onDelete('cascade');
            
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
        Schema::dropIfExists('main_groups');
    }
}
