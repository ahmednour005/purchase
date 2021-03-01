<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('vaild')->nullable();
            $table->string('email')->unique();
            $table->string('location')->nullable();
            $table->text('job_title')->nullable();
            $table->text('direct_manager')->nullable();
            $table->text('department')->nullable();
            $table->text('phone')->nullable();
            $table->text('level')->nullable();
            $table->text('code')->nullable();
            $table->text('workgroup')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
