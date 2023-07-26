<?php

use App\Models\Box;
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
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('opening');
            $table->dateTime('closing')->nullable();
            $table->decimal('initial',6,2);
            $table->decimal('income',6,2)->default(0.00);//ingresos
            $table->decimal('expenses',6,2)->default(0.00);//egresos
            $table->decimal('balance',6,2)->default(0.00);//saldo
            $table->decimal('final',6,2)->default(0.00);
            $table->string('observation',100)->nullable();
            $table->enum('status',[Box::ABIERTO,Box::CERRADO]);
            $table->foreignId('user_id')->constrained();



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
        Schema::dropIfExists('boxes');
    }
};
