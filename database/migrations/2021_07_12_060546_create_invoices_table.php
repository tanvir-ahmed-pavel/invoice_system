<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {


            $table->id();
            $table->string('invoice_number')->unique()->nullable();
            $table->uuid('invoice_signature')->unique()->nullable();
            $table->string('invoice_type');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('subject');
            $table->string('car_details')->nullable();
            $table->float('tax')->nullable();
            $table->float('vat')->nullable();
            $table->double('sub_total');
            $table->double('net_amount');
            $table->double('discount')->nullable();
            $table->double('advance_paid')->nullable();
            $table->date('date');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
