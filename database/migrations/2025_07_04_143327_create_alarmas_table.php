<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alarmas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('serie');
            $table->string('responsable');
            $table->string('tipo');
            $table->float('radio');
            $table->float('latitud');
            $table->float('longitud');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alarmas');
    }
};
