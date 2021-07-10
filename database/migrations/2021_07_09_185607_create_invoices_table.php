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
            $table->uuid("invoice_id");
            $table->integer("user_id");
            $table->string("subject");
            $table->string("car_details");
            $table->integer("driver_id");
            $table->foreign("driver_id")->references("id")->on("drivers");
            $table->foreign("user_id")->references("id")->on("users");
            $table->integer("client_id");
            $table->foreign("client_id")->references("id")->on("clients");
            $table->integer("tax");
            $table->integer("vat");
            $table->date("date");
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
        Schema::dropIfExists('invoices');
    }
}
