<?php

use App\Vendor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description', 1000);
            $table->integer('amount')->unsigned();
            $table->string('status')->default(Vendor::UNAVAILABLE_VENDOR);
            $table->bigInteger('seller_id')->unsigned();
            $table->timestamps();   
            $table->softDeletes();
            $table->foreign('seller_id')->references('id')->on('users');
            
        });

        
           
      
    }


   

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}
