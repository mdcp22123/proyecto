<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quantity');       
            $table->decimal('price',15,10);

            $table->decimal('price_u',15,10);
            $table->decimal('tax_u',15,10);
            $table->decimal('net_u',15,10);

            $table->decimal('net_t',15,10);
            $table->decimal('tax_t',15,10);
            $table->decimal('price_t',15,10);

            $table->text('description');
            $table->foreignId('sale_id')->constrained();
            $table->foreignId('service_id')->constrained();
   
       
      

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
        Schema::dropIfExists('details');
    }
};
