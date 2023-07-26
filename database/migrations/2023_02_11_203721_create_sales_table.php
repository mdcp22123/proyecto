<?php

use App\Models\Sale;
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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->decimal('net',15,10);
            $table->decimal('tax',15,10);
            $table->decimal('discount',15,2);
            $table->decimal('subtotal',15,10);
   /*          $table->decimal('rounding',6,2);//redondeo a favot del cliente */
            $table->decimal('total',15,10);
            $table->decimal('cash',15,2);//efectivo recibido
            $table->decimal('change',15,2);//cambio a devolver
            $table->enum('status',[Sale::REGISTRADO,Sale::ANULADO,Sale::FACTURADO]);//1=registrado, 2=anulado
            $table->enum('type',[Sale::LIBRE,Sale::TERCERO]);
            $table->text('observation')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('patient_id')->constrained();
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
        Schema::dropIfExists('sales');
    }
};
