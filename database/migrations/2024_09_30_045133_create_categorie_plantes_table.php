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
        Schema::create('categorie_plantes', function (Blueprint $table) {
            $table->id(); // Primary key: 'id' column
            $table->string('nom')->unique(); // Category name, unique
            $table->string('slug')->unique(); // URL-friendly name, unique
            $table->text('description')->nullable(); // Optional description
            $table->string('image_url')->nullable(); // Optional image URL
            $table->foreignId('parent_id')->nullable()->constrained('categorie_plantes')->onDelete('cascade'); // For nested categories
            $table->timestamps(); // 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorie_plantes');
    }
};
