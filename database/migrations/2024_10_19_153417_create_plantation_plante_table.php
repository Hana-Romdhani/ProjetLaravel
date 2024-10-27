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
        Schema::create('plantation_plante', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plantation_id')->constrained('plantation')->onDelete('cascade');
            $table->foreignId('plantes_id')->constrained('plantes')->onDelete('cascade');
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
        Schema::dropIfExists('plantation_plante');
    }
};
