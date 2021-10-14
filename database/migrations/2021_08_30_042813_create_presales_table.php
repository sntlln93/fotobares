<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presales', function (Blueprint $table) {
            $table->id();
            $table->string("lastname");
            $table->string("name");
            $table->string("information")->nullable();
            $table->date('contact_date')->nullable();
            
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->foreign('seller_id')->references('id')->on('employees')->onDelete('set null');

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
        Schema::dropIfExists('presales');
    }
};
