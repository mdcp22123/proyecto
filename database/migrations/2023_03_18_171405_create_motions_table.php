<?php

use App\Models\Motion;
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
        Schema::create('motions', function (Blueprint $table) {
            $table->id();
            $table->enum('type',[Motion::INGRESO,Motion::EGRESO]);
            $table->string('description',100);
            $table->decimal('amount',6,2);
            $table->foreignId('box_id')->constrained();
            $table->foreignId('sale_id')->nullable()->constrained();
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
        Schema::dropIfExists('motions');
    }
};
