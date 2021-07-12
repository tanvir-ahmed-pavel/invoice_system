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
            $table->uuid('invoice_number');
            $table->unsignedBigInteger('user_id');
            $table->string('subject')->nullable();
            $table->string('car_details')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->float('tax')->nullable();
            $table->float('vat')->nullable();
            $table->date('date');
            $table->timestamps();

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
