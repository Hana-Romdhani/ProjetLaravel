<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvenementsTable extends Migration
{
    public function up()
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location');
            $table->text('description');
            $table->date('date');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('classification_id'); // Define the classification_id column

            // Add foreign key constraint
            $table->foreign('classification_id')
                ->references('id')
                ->on('classifications')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('evenements', function (Blueprint $table) {
            $table->dropForeign(['classification_id']);
            $table->dropIndex(['classification_id']);
        });
        Schema::dropIfExists('evenements');
    }
}