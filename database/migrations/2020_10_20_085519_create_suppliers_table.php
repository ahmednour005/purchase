<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('company', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('company_mobile', 255)->nullable();
            $table->string('fax', 255)->nullable();
            $table->string('supplier_email', 255)->nullable();
            $table->string('supplier_password', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->text('address')->nullable();
            $table->text('address_link')->nullable();
            $table->text('website')->nullable();
            $table->string('accredite', 255)->nullable();
            $table->text('profile_image')->nullable();
            $table->text('tax_card_image')->nullable();
            $table->text('commercial_register_image')->nullable();
            $table->text('tax_card_pdf')->nullable();
            $table->text('commercial_register_pdf')->nullable();
            $table->text('service_note')->nullable();
            $table->text('person_note')->nullable();
            $table->text('accredite_note')->nullable();
            $table->integer('archive')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
