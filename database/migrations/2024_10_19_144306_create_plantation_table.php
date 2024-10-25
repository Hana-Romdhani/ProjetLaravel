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
        // Schema::create('plantation', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
        //     $table->foreignId('jardin_id')->constrained('jardins')->onDelete('cascade'); 
        //     $table->string('nom'); 
        //     $table->timestamps();
        // });
        Schema::create('plantations', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->foreignId('jardin_id')->constrained('jardins')->onDelete('cascade'); 
            $table->string('nom'); 
            $table->date('date_plantation'); 
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
        Schema::dropIfExists('plantation');
    }
};
