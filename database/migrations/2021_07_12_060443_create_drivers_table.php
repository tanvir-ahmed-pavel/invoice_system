<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {

            $table->id();
            $table->string("name");
            $table->string("contact");
            $table->unsignedBigInteger("user_id")->nullable();
            $table->unsignedBigInteger("client_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("client_id")->references("id")->on("clients");
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
        Schema::dropIfExists('drivers');
    }
}
