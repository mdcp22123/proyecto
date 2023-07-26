<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Proof;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proofs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number');
            $table->string('voucher');
            $table->string('serie');
            $table->string('correlative'); 
            $table->string('address')->nullable();
            $table->string('response')->nullable();
            $table->text('observation')->nullable();
            $table->string('hash');
            $table->string('xml')->nullable();
            $table->string('cdr')->nullable();        
            $table->enum('status',[Proof::PENDIENTE,Proof::ACEPTADO,Proof::RECHAZADO,Proof::EXECEPCION,Proof::ANULADO]);
            $table->foreignId('sale_id')->constrained();       
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
        Schema::dropIfExists('proofs');
    }
};
