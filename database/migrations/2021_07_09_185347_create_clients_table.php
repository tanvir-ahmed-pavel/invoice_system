<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->foreign("user_id")->references("id")->on("users");
            $table->string("client_name");
            $table->string("representative_name");
            $table->string("representative_contact");
            $table->string("client_address");
            $table->string("client_email");
            $table->string("client_contact");
            $table->string("client_other_info");
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
        Schema::dropIfExists('clients');
    }
}
